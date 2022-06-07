<?php

namespace App\Services;


use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Location;
use App\Models\Repair;
use App\Models\TaxRate;
use App\Models\LaborRate;
use App\Models\PartRate;
use App\Models\MaterialRate;
use App\Models\SubTotal;
use App\Models\Total;
use App\Models\Line;
use App\Models\PartInfo;
use App\Models\LaborInfo;
use App\Models\RefinishLaborInfo;
use App\Models\OtherChargesInfo;
use App\Models\CCCModel;
use App\Models\CCCVehicle;
use App\Models\CCCSmartOpt;
use App\Models\CCCOption;
use App\Models\VehicleOption;
use App\Helpers\CCCMaps;
use OperCodes;
use Auth;

class CCCBmsImport
{
  public $xml;
  private $repair;
  private $location;
  private $tax_rate;
  private $rf_name;
  private $rf_id;
  private $rf_phone;
  private $rf_address_1;
  private $rf_address_2;
  private $rf_city;
  private $rf_state;
  private $rf_zip;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($xml_string)
    {
      $this->xml = simplexml_load_string($xml_string);
      $this->rf_name = $this->xml->AdminInfo->RepairFacility->Party->OrgInfo->CompanyName;
      $this->rf_id = $this->xml->AdminInfo->RepairFacility->Party->OrgInfo->IDInfo->IDNum;
      foreach($this->xml->AdminInfo->RepairFacility->Party->OrgInfo->Communications as $com){
        if(OperCodes::access('bus_phone', (string)$com->CommQualifier)){
          $this->rf_phone = $com->CommPhone;
        }
        if(OperCodes::access('com_address', (string)$com->CommQualifier)){
          $this->rf_address_1 = $com->Address->Address1;
          $this->rf_address_2 = $com->Address->Address2;
          $this->rf_city = $com->Address->City;
          $this->rf_state = $com->Address->StateProvince;
          $this->rf_zip = $com->Address->PostalCode;
        }
      }
    }


    public function check_location()
    {
      $rf_id = $this->xml->AdminInfo->RepairFacility->Party->OrgInfo->IDInfo->IDNum;
      $location = Location::where('ccc_rf_id', $rf_id)->first();
      if(!$location){
        $location = Location::where('name', $this->rf_name)->where('address_1', $this->rf_address_1)->where('city', $this->rf_city)->where('state', $this->rf_state)->first();
      }
      return $location ? $location->id : null;
    }

    public function process()
    {
      $this->build_repair();
      $this->build_options();
      $this->build_tax_rates();
      $this->build_part_rates();
      $this->build_labor_rates();
      $this->build_material_rates();
      $this->build_subtotals();
      $this->build_totals();
      $this->build_lines();
      return $this->repair;
    }

    private function build_repair()
    {
      $data = [
        'document_ver_code' => $this->xml->DocumentInfo->DocumentVer->DocumentVerCode,
        'document_ver_code_desc' => OperCodes::access('doc_ver', (string)$this->xml->DocumentInfo->DocumentVer->DocumentVerCode),
        'document_ver_num' => $this->xml->DocumentInfo->DocumentVer->DocumentVerNum,
        'document_status' => $this->xml->DocumentInfo->DocumentStatus,
        'document_status_desc' => OperCodes::access('doc_status', (string)$this->xml->DocumentInfo->DocumentStatus),
        'ins_company_name' => $this->xml->AdminInfo->InsuranceCompany->Party->OrgInfo->CompanyName,
        'ownr_fn' => $this->xml->AdminInfo->Owner->Party->PersonInfo->PersonName->FirstName,
        'ownr_ln' => $this->xml->AdminInfo->Owner->Party->PersonInfo->PersonName->LastName,
        'estimator_fn' => $this->xml->AdminInfo->Estimator->Party->PersonInfo->PersonName->FirstName,
        'estimator_ln' => $this->xml->AdminInfo->Estimator->Party->PersonInfo->PersonName->LastName,
        'rf_name' => $this->rf_name,
        'rf_id' => $this->rf_id,
        'rf_phone' => $this->rf_phone,
        'rf_address_1' => $this->rf_address_1,
        'rf_address_2' => $this->rf_address_2,
        'rf_city' => $this->rf_city,
        'rf_state' => $this->rf_state,
        'rf_zip' => $this->rf_zip,
        'ro_id' => $this->xml->DocumentInfo->ReferenceInfo->RepairOrderID,
        'est_system' => $this->xml->ApplicationInfo->ApplicationName,
        'v_vin' => $this->xml->VehicleInfo->VINInfo->VIN->VINNum,
        'v_prod_dt' => $this->xml->VehicleInfo->VehicleDesc->ProductionDate,
        'v_model_yr' => $this->xml->VehicleInfo->VehicleDesc->ModelYear,
        'v_makecode' => $this->xml->VehicleInfo->VehicleDesc->MakeDesc,
        'v_makedesc' => CCCMaps::get_make((string)$this->xml->VehicleInfo->VehicleDesc->MakeDesc),
        'v_model' => $this->xml->VehicleInfo->VehicleDesc->ModelName,
        'v_mileage' => $this->xml->VehicleInfo->VehicleDesc->OdometerInfo->OdometerReading,
        'v_color' => $this->xml->VehicleInfo->Paint->Exterior->Color->ColorName,
        'v_style' => $this->xml->VehicleInfo->Body->BodyStyle,
        'clm_no' => $this->xml->ClaimInfo->ClaimNum,
      ];

      foreach($this->xml->AdminInfo->Owner->Party->PersonInfo->Communications as $com){

        if(OperCodes::access('com_phone', (string)$com->CommQualifier)){
          $data['ownr_phone'] = $com->CommPhone;
        }

        if(OperCodes::access('com_address', (string)$com->CommQualifier)){
          $data['ownr_address_1'] = $com->Address->Address1;
          $data['ownr_address_2'] = $com->Address->Address2;
          $data['ownr_city'] = $com->Address->City;
          $data['ownr_state'] = $com->Address->StateProvince;
          $data['ownr_zip'] = $com->Address->PostalCode;
        }

      }



      $this->repair = Repair::updateOrCreate(
                  [
                    'document_id' => $this->xml->DocumentInfo->DocumentID,
                    'location_id' => self::check_location()
                  ],
                  $data
                );

          return true;
    }

    private function build_options()
    {
      $model = CCCModel::where('model', $this->repair->v_model)->first();

      if($model){
        $veh = CCCVehicle::where('model_code', $model->model_code)->where('v_year', $this->repair->v_model_yr)->first();
        $opt_str = CCCSmartOpt::where('opt_id', $veh->std_veh_opt_code)->first()->options;
        $length = strlen($opt_str) / 3;

        $list = [];
        for($i = 0; $i < $length; $i++){
          $o = substr($opt_str, $i * 3, 3);
          if($o[2] === 'S'){
            $list[] = substr($o, 0, 2);
          }
        }
        $d_list = [];
        foreach($list as $l){
          $c_opt = CCCOption::where('option_code', $l)->with('opt_group')->first();
          if($c_opt){
            $d_list[] = $c_opt;
          }
        }

        foreach($d_list as $d_opt){
          VehicleOption::updateOrCreate(
              [
                'repair_id' => $this->repair->id,
                'option_code' => $d_opt->option_code
              ],
              [
                'option_desc' => $d_opt->description,
                'grp_description' => $d_opt->opt_group->description,
                'display_order' => (int)$d_opt->opt_group->display_order
              ]
            );
        }
      }
    }

    private function build_tax_rates()
    {
      $rates = $this->xml->ProfileInfo->RateInfo;

      foreach($rates as $rate){
        if($rate->RateType == 'ALL'){
          $this->tax_rate = TaxRate::updateOrCreate(
                      [
                        'repair_id' => $this->repair->id,
                        'tax_type' => 'ALL'
                      ],
                      [
                        'tax_rate' => $rate->TaxInfo->TaxTierInfo->Percentage,
                        'tax_desc' => 'ALL'
                      ]
                    );
        }
      }
    }

    private function build_part_rates()
    {
      $rates = $this->xml->ProfileInfo->RateInfo;

      foreach($rates as $rate){
        $part_type = OperCodes::access('part_type', (string)$rate->RateType);
        if($part_type && (bool)$rate->AdjustmentInfo){
          foreach($rate->AdjustmentInfo as $adj){
            if($adj->AdjustmentType == 'Discount' && (int)$adj->AdjustmentPct > 0){
              PartRate::updateOrCreate(
                          [
                            'repair_id' => $this->repair->id,
                            'part_type' => $rate->RateType,
                            'adj_type' => 'Discount'
                          ],
                          [
                            'adj_pct' => (int)$adj->AdjustmentPct,
                          ]
                        );
            }
          }

        }
      }
    }


    private function build_labor_rates()
    {
      $rates = $this->xml->ProfileInfo->RateInfo;

      foreach($rates as $rate){
        $labor_type = OperCodes::access('labor_type', (string)$rate->RateType);
        if($labor_type){
          LaborRate::updateOrCreate(
                      [
                        'repair_id' => $this->repair->id,
                        'lbr_type' => $rate->RateType
                      ],
                      [
                        'lbr_desc' => $labor_type,
                        'lbr_rate' => $rate->RateTierInfo->Rate,
                        'taxable' => $rate->TaxInfo->TaxableInd == 'true' ? 1 : 0
                      ]
                    );
        }
      }
    }


    private function build_material_rates()
    {
      $rates = $this->xml->ProfileInfo->RateInfo;

      foreach($rates as $rate){
        $material_type = OperCodes::access('material_type', (string)$rate->RateType);
        if($material_type){
          MaterialRate::updateOrCreate(
                      [
                        'repair_id' => $this->repair->id,
                        'matl_type' => $rate->RateType
                      ],
                      [
                        'matl_desc' => $material_type,
                        'matl_rate' => (int)$rate->RateTierInfo->Rate,
                        'taxable' => $rate->TaxInfo->TaxableInd == 'true' ? 1 : 0
                      ]
                    );
        }
      }
    }


    private function build_subtotals()
    {
      $sub_totals = $this->xml->RepairTotalsInfo;

      foreach($sub_totals->LaborTotalsInfo as $sub){
        if((float)$sub->TotalAmt > 0){
          SubTotal::updateOrCreate(
                      [
                        'repair_id' => $this->repair->id,
                        'ttl_type' => $sub->TotalType
                      ],
                      [
                        'ttl_desc' => $sub->TotalTypeDesc,
                        't_amt' => $sub->TotalAmt,
                        't_hrs' => $sub->TotalHours
                      ]
                    );
        }
      }


      foreach($sub_totals->PartsTotalsInfo as $sub){
        if((float)$sub->TotalAmt > 0){
          SubTotal::updateOrCreate(
                      [
                        'repair_id' => $this->repair->id,
                        'ttl_type' => $sub->TotalType
                      ],
                      [
                        'ttl_desc' => $sub->TotalTypeDesc,
                        't_amt' => $sub->TotalAmt,
                      ]
                    );
        }
      }

      foreach($sub_totals->OtherChargesTotalsInfo as $sub){
        if((float)$sub->TotalAmt > 0){
          SubTotal::updateOrCreate(
                      [
                        'repair_id' => $this->repair->id,
                        'ttl_type' => $sub->TotalType
                      ],
                      [
                        'ttl_desc' => $sub->TotalTypeDesc,
                        't_amt' => $sub->TotalAmt,
                      ]
                    );
        }
      }

    }


    private function build_totals()
    {
      $totals = $this->xml->RepairTotalsInfo->SummaryTotalsInfo;

      foreach($totals as $total){
        if((float)$total->TotalAmt > 0){
          Total::updateOrCreate(
                      [
                        'repair_id' => $this->repair->id,
                        'ttl_type' => $total->TotalSubType
                      ],
                      [
                        'ttl_desc' => $total->TotalTypeDesc,
                        't_amt' => $total->TotalAmt,
                      ]
                    );
        }
      }
    }


    private function build_lines()
    {
      $lines = $this->xml->DamageLineInfo;

      foreach($lines as $line){
        $curr = Line::updateOrCreate(
                    [
                      'repair_id' => $this->repair->id,
                      'unique_sequence_num' => $line->UniqueSequenceNum
                    ],
                    [
                      'line_num' => $line->LineNum,
                      'estimate_ver_code' => $line->EstimateVerCode,
                      'estimate_ver_desc' => OperCodes::access('doc_ver', (string)$line->EstimateVerCode),
                      'manual_line_ind' => $line->ManualLineInd == 'true' ? 1 : 0,
                      'line_status_code' => $line->LineStatusCode,
                      'line_status_desc' => OperCodes::access('line_status', (string)$line->LineStatusCode),
                      'line_desc' => $line->LineDesc,
                      'is_header' => CCCMaps::check_is_group((string)$line->LineDesc),
                      'is_child' => (bool)$line->ParentLineNum,
                      'desc_judgement_ind' => $line->DescJudgmentInd == 'true' ? 1 : 0,
                      'line_memo' => (bool)$line->LineMemo ? $line->LineMemo : null,
                      'is_sublet' => (bool)$line->SubletInfo ? 1 : 0
                    ]
                  );
          $this->build_line_sub_info($line, $curr);
      }
    }

    private function build_line_sub_info($x_line, $line)
    {
      (bool)$x_line->PartInfo && $this->build_part_info($x_line->PartInfo, $line);
      (bool)$x_line->LaborInfo && $this->build_labor_info($x_line->LaborInfo, $line);
      (bool)$x_line->RefinishLaborInfo && $this->build_refinish_labor_info($x_line->RefinishLaborInfo, $line);
      (bool)$x_line->OtherChargesInfo && $this->build_other_charges_info($x_line->OtherChargesInfo, $line);
    }

    private function modify_line_desc($with, $type, $line, $new)
    {
      $modifier = OperCodes::access($with, (string)$type);
      if($modifier){
        $line->update([
          'line_desc' => $this->prepend($line->line_desc, $modifier)
        ]);
        $new->update([
          'line_desc_modifier' => $modifier
        ]);
      }

      return;
    }

    private function prepend($line, $modifier)
    {
      $new = trim($line);
      $new = $modifier . ' ' . $new;
      return $new;
    }


    private function build_part_info($part, $line)
    {
      //return OperCodes::access('part_type', (string)$part->PartType);
      $new_part = PartInfo::updateOrCreate(
                  [
                    'line_id' => $line->id,
                  ],
                  [
                    'part_type' => $part->PartType,
                    'part_type_desc' => OperCodes::access('part_type', (string)$part->PartType),
                    'part_num' => $part->PartNum,
                    'oem_part_num' => $part->OEMPartNum,
                    'part_price' => $part->PartPrice,
                    'unit_part_price' => $part->UnitPartPrice,
                    'taxable' => $part->TaxableInd == 'true' ? 1 : 0,
                    'price_judgement_ind' => $part->PriceJudgmentInd == 'true' ? 1 : 0,
                    'alternate_part_ind' => $part->AlternatePartInd == 'true' ? 1 : 0,
                    'glass_part_ind' => $part->GlassPartInd == 'true' ? 1 : 0,
                    'price_incl_ind' => $part->PriceInclInd == 'true' ? 1 : 0,
                    'quantity' => $part->Quantity,
                    'price_adjustment' => (bool)$part->PriceAdjustment,
                    'adjustment_pct' => (bool)$part->PriceAdjustment ? $part->PriceAdjustment->AdjustmentPct : null
                  ]
                );

        $this->modify_line_desc('modifier', $part->PartType, $line, $new_part);
    }


    private function build_labor_info($labor, $line)
    {
      LaborInfo::updateOrCreate(
                  [
                    'line_id' => $line->id,
                  ],
                  [
                    'labor_type' => $labor->LaborType,
                    'labor_type_desc' => OperCodes::access('labor_type', (string)$labor->LaborType),
                    'labor_flag' => OperCodes::access('labor_flag', (string)$labor->LaborType),
                    'database_labor_type' => $labor->DatabaseLaborType,
                    'database_labor_type_desc' => OperCodes::access('labor_type', (string)$labor->DatabaseLaborType),
                    'labor_operation' => $labor->LaborOperation,
                    'labor_operation_desc' => OperCodes::access('oper_desc', (string)$labor->LaborOperation),
                    'labor_oper_display' => OperCodes::access('ccc_oper', (string)$labor->LaborOperation),
                    'labor_hours' => $labor->LaborHours,
                    'database_labor_hours' => $labor->DatabaseLaborHours,
                    'labor_incl_ind' => $labor->LaborInclInd == 'true' ? 1 : 0,
                    'labor_amt' => $labor->LaborAmt,
                    'taxable' => $labor->TaxableInd == 'true' ? 1 : 0,
                    'labor_hours_judgement_ind' => $labor->LaborHoursJudgmentInd == 'true' ? 1 : 0,
                    'labor_type_judgement_ind' => $labor->LaborTypeJudgmentInd == 'true' ? 1 : 0,
                  ]
                );
    }



    private function build_refinish_labor_info($labor, $line)
    {
      RefinishLaborInfo::updateOrCreate(
                  [
                    'line_id' => $line->id,
                  ],
                  [
                    'labor_type' => $labor->LaborType,
                    'labor_type_desc' => OperCodes::access('labor_type', (string)$labor->LaborType),
                    'database_labor_type' => $labor->DatabaseLaborType,
                    'database_labor_type_desc' => OperCodes::access('labor_type', (string)$labor->DatabaseLaborType),
                    'labor_operation' => $labor->LaborOperation,
                    'labor_operation_desc' => OperCodes::access('oper_desc', (string)$labor->LaborOperation),
                    'labor_oper_display' => OperCodes::access('ccc_oper', (string)$labor->LaborOperation),
                    'labor_hours' => $labor->LaborHours,
                    'database_labor_hours' => $labor->DatabaseLaborHours,
                    'labor_incl_ind' => $labor->LaborInclInd == 'true' ? 1 : 0,
                    'labor_amt' => $labor->LaborAmt,
                    'taxable' => $labor->TaxableInd == 'true' ? 1 : 0,
                    'labor_hours_judgement_ind' => $labor->LaborHoursJudgmentInd == 'true' ? 1 : 0,
                    'labor_type_judgement_ind' => $labor->LaborTypeJudgmentInd == 'true' ? 1 : 0,
                  ]
                );
    }


    private function build_other_charges_info($charges, $line)
    {
      OtherChargesInfo::updateOrCreate(
                  [
                    'line_id' => $line->id,
                  ],
                  [
                    'other_charges_type' => $charges->OtherChargesType,
                    'other_charges_type_desc' => OperCodes::access('total_type', (string)$charges->OtherChargesType),
                    'price' => $charges->Price,
                    'unit_of_measure' => $charges->UnitOfMeasure,
                    'quantity' => $charges->Quantity,
                    'price_incl_ind' => $charges->PriceInclInd == 'true' ? 1 : 0,
                  ]
                );
    }

}

?>
