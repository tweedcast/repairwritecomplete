<?php
namespace App\Helpers;

class OperationCodes {

  public static $doc_status = [
    'C' => 'Committed',
    'I' =>	'In-Progress',
    'O' =>	'Open',
    'V' =>	'Voided',
    'Z' =>	'Closed',
  ];

  public static $doc_ver = [
    'DM' =>	'Prior Damage Report',
    'EM' =>	'Original',
    'ME' =>	'Memorandum',
    'RD' =>	'Related Prior Damage Report',
    'SV' =>	'Supplement',
    'UD' =>	'Unrelated Prior Damage Report',
    'UP' =>	'Update',
    'VN' =>	'Version',
  ];

  public static $com_phone = [
    'CP' =>	'Cellular Phone Number',
    'HP' =>	'Home Phone Number',
    'PC' =>	'Personal Cellular Number',
  ];

  public static $bus_phone = [
    'CP' =>	'Cellular Phone Number',
    'TE' =>	'Telephone (With Unknown Type)',
    'WC' =>	'Work Cellular Number',
    'WP' =>	'Business Phone Number',
  ];

  public static $com_address = [
    'AL' =>	'Address/Location (With Unknown Type)',
    'SA' =>	'Street Address',
    'WA' =>	'Work Address',
  ];

  public static $oper_desc = [
    'OP11' => 'Replace',
    'OP12' => 'Replace, Partial',
    'OP24' => 'Chip Guard',
    'OP25' => 'Two Tone',
    'OP26' => 'Paintless Dent Repair',
    'OP3' => 'Additional Repair',
    'OP4' => 'Alignment',
    'OP5' => 'Overhaul',
    'OP6' => 'Refinish',
    'OP7' => 'Inspect',
    'OP8' => 'Check/Adjust',
    'OP9' => 'Repair',
    'OP0' => 'Blank',
    'OP1' => 'Refinish/Repair',
    'OP10' => 'Repair, Partial',
    'OP11' => 'Remove/Replace',
    'OP12' => 'Remove/Replace, Partial',
    'OP13' => 'Additional Costs',
    'OP14' => 'Additional Operations',
    'OP15' => 'Blend',
    'OP16' => 'Sublet',
    'OP17' => 'Related Prior Damage',
    'OP18' => 'Appearance Allowance',
    'OP19' => 'Unrelated Prior Damage',
    'OP2' => 'Remove/Install',
    ];

    public static $ccc_oper = [
      'OP11' => 'Repl',
      'OP4' => 'Align',
      'OP6' => 'Refn',
      'OP7' => 'Insp',
      'OP9' => 'Rpr',
      'OP11' => 'Repl',
      'OP15' => 'Blnd',
      'OP16' => 'Subl',
      'OP2' => 'R&I',
    ];

  public static $labor_type = [
    'LAB' => 'Body',
    'LABA' => 'Body, Additional Labor',
    'LABS' => 'Body, Sublet',
    'LAD' => 'Diagnostic',
    'LADT' => 'Drill Time',
    'LAE2' => '2 stage edge',
    'LAE' => 'Electrical',
    'LAET' => 'Edging Time',
    'LAF' => 'Frame',
    'LAFA' => 'Frame, Additional Labor',
    'LAFS' => 'Frame, Sublet',
    'LAG' => 'Glass',
    'LAGA' => 'Glass, Additional Labor',
    'LAGS' => 'Glass, Sublet',
    'LAI' => 'Installation & Wiring',
    'LAM' => 'Mechanical',
    'LAMA' => 'Mechanical, Additional Labor',
    'LAMS' => 'Mechanical, Sublet',
    'LAR' => 'Refinish',
    'LARA' => 'Refinish, Additional Labor',
    'LARS' => 'Refinish, Sublet',
    'LAS' => 'Structural',
    'LASA' => 'Structural, Additional Labor',
    'LASS' => 'Structural, Sublet',
    'LASU' => 'Surface',
    'LAUT' => 'Underside Time',
  ];

  public static $part_type = [
    'AD' =>	'Adhesive Kit',
    'GA' =>	'Gasket',
    'GF' =>	'Glass Frame',
    'GL' =>	'Glass',
    'HW' =>	'Hardware',
    'IM' =>	'Installation Materials',
    'LO' =>	'Labor Only',
    'MO' =>	'Mouldings',
    'OT' =>	'Other',
    'PAA' =>	'Aftermarket',
    'PAC' =>	'Rechromed',
    'PAD' =>	'Reconditioned',
    'PAE' =>	'Existing',
    'PAG' =>	'Glass',
    'PAGN' =>	'Non-OEM Glass',
    'PAL' =>	'Recycled OE',
    'PAM' =>	'Remanufactured',
    'PAMR' =>	'Recycled Remanufactured',
    'PAN' =>	'OEM',
    'PAND' =>	'OEM discounted',
    'PAO' =>	'Other',
    'PAP' =>	'New, partial',
    'PAR' =>	'Re-cored',
    'PC' =>	'Core only',
    'PRA' =>	'Recycled Aftermarket',
    'PROE' =>	'Recovered OE',
    'PRR' =>	'Recycled Replaced with OE' ,
    'PSOE' =>	'Surplus OE',
    'RP' =>	'Repair',
    'TI' =>	'Tinting',
    'WE' =>	'Weatherstrip',
    'PAS' => 'Sublet',
  ];

  public static $material_type = [
    'MA2S' =>	'Two-Stage Paint(Clear Coat)',
    'MA2T' =>	'Two Tone Paint',
    'MA3S' =>	'Three-Stage Paint',
    'MABL' =>	'Blend',
    'MACS' =>	'Color Sand and Buff',
    'MAFP' =>	'Feather Prime and Block',
    'MAHW' =>	'Hazardous Waste',
    'MAPA' =>	'Paint',
    'MASH' =>	'Shop',
    'MASP' =>	'Small Parts',
    'MAT' =>	'Total',
    'MATD' =>	'Tire Disposal',
  ];

  public static $labor_flag = [
    'LAF' => 'F',
    'LAM' => 'M',
    'LAS' => 'S',
    'LAG' => 'G',
  ];

  public static $sub_total_type = [
    'MAT' => 'Paint & Materials',
    'PAT' => 'Parts',
    'LAB' => 'Body Labor',
    'LAR' => 'Refinish Labor',
    'LAM' => 'Mechanical Labor',
    'LAS' => 'Structural Labor',
    'LAF' => 'Frame Labor',
    'LAS' => 'Sublet Labor',
    'LAD' => 'Diagnostic Labor',
    'LAE' => 'Electrical Labor',
    'LAG' => 'Glass Labor',
  ];

  public static $total_type = [
    'ATS' =>	'Alternative Transportation Allowance',
    'BE' =>	'Betterment',
    'BEAC' =>	'Betterment - Additional Cost',
    'BELA' =>	'Betterment - Labor',
    'BELP' =>	'Betterment - Labor and Paint',
    'BEPA' =>	'Betterment - Parts Betterment',
    'BEPL' =>	'Betterment - Parts and Labor',
    'BEPM' =>	'Betterment - Paint and Materials',
    'BEPO' =>	'Betterment - Parts, Labor, and Paint',
    'BEPP' =>	'Betterment - Parts and Paint',
    'BESL' =>	'Betterment - Sublet',
    'BETP' =>	'Betterment - Total Paint',
    'DE' =>	'Deductible',
    'DEME' =>	'Deductible Mobile Electronics/Endorsement',
    'DEPP' =>	'Deductible Previously Paid',
    'DEPR' =>	'Depreciation',
    'FEE' =>	'Fees for Valuation',
    'LA' =>	'Labor',
    'LA1' =>	'User Defined Labor 1',
    'LA1A' =>	'User Defined Labor 1, Additional Labor',
    'LA2' =>	'User Defined Labor 2',
    'LA2S' =>	'Labor - 2 Stage',
    'LA2U' =>	'Labor - 2 Stage Setup',
    'LA3' =>	'User Defined Labor 3',
    'LA3S' =>	'Labor - 3 Stage',
    'LA3U' =>	'Labor - 3 Stage Setup',
    'LA4' =>	'User Defined Labor 4',
    'LAA' =>	'Labor - Aluminum',
    'LAAA' =>	'Labor - Aluminum, Additional Labor',
    'LAAS' =>	'Labor - Aluminum, Sublet',
    'LAB' =>	'Labor - Body',
    'LABA' =>	'Labor - Body, Additional Labor',
    'LABS' =>	'Labor - Body, Sublet',
    'LACG' =>	'Chipguard',
    'LAD' =>	'Labor - Diagnostic',
    'LADT' =>	'Labor - Drill Time',
    'LAE' =>	'Labor - Electrical',
    'LAE2' =>	'Labor, 2 stage edge',
    'LAE3' =>	'3 Stage Edge',
    'LAEA' =>	'Labor - Electrical, Addional Labor',
    'LAET' =>	'Labor - Edging Time',
    'LAF' =>	'Labor - Frame',
    'LAFS' =>	'Labor - Frame, Sublet',
    'LAFA' =>	'Labor - Frame, Additional Labor',
    'LAG' =>	'Labor - Glass',
    'LAGA' =>	'Labor - Glass, Additional Labor',
    'LAGS' =>	'Labor - Glass, Sublet',
    'LAI' =>	'Labor - Installation & Wiring',
    'LAM' =>	'Labor - Mechanical',
    'LAMA' =>	'Labor - Mechanical, Additional Labor',
    'LAMS' =>	'Labor - Mechanical, Sublet',
    'LAP' =>	'Labor - Paintless Dent Repair',
    'LAPA' =>	'Labor - Paintless Dent Repair, Additional Labor',
    'LAPS' =>	'Labor - Paintless Dent Repair, Sublet',
    'LAR' =>	'Labor - Refinish',
    'LARA' =>	'Labor - Refinish, Additional Labor',
    'LARN' =>	'Refinish, No Materials',
    'LARS' =>	'Labor - Refinish, Sublet',
    'LAS' =>	'Labor - Structural',
    'LASA' =>	'Labor - Structural, Additional Labor',
    'LASS' =>	'Labor - Structural, Sublet',
    'LASU' =>	'Labor - Surface',
    'LAT' =>	'Labor - Total',
    'LATA' =>	'Labor - Total, Additional Labor',
    'LATT' =>	'Labor 2 Tone',
    'LAU' =>	'User Defined Labor',
    'LAUT' =>	'Labor - Underside Time',
    'MA2S' =>	'Materials - Two-Stage Paint (Clear Coat)',
    'MA2T' =>	'Materials - Two Tone Paint',
    'MA3S' =>	'Materials - Three-Stage Paint',
    'MAAC' =>	'Materials - Anticorrosion',
    'MAFP' =>	'Materials - Feather, Prime and Block',
    'MAHW' =>	'Materials - Hazardous Waste',
    'MAIN' =>	'Materials - Installation',
    'MAPA' =>	'Materials - Paint',
    'MASH' =>	'Materials - Shop',
    'MASP' =>	'Materials - Small Parts',
    'MAT' =>	'Materials - Total',
    'MAUP' =>	'Materials - Underside Paint',
    'NRLA' =>	'Non-Taxable Labor Related Prior Damage',
    'NRPA' =>	'Non-Taxable Parts Related Prior Damage',
    'NTC' =>	'Non-Taxable Costs',
    'NTL' =>	'Non-Taxable Labor',
    'NTP' =>	'Non-Taxable Parts',
    'NULA' =>	'Non-Taxable Labor UnRelated Prior Damage',
    'NUPA' =>	'Non-Taxable Parts Unrelated Prior Damage',
    'OT1' =>	'Other - User Defined 1',
    'OT2' =>	'Other - User Defined 2',
    'OT4' =>	'Other - User Defined 4',
    'OT3' =>	'Other - User Defined 3',
    'OTAA' =>	'Other - Appearance Allowance',
    'OTAC' =>	'Other - Additional Cost',
    'OTAD' =>	'Other Appearance Allowance Less Deductible',
    'OTCO' =>	'Other - Core',
    'OTCR' =>	'Other - Customer Responsibility',
    'OTDP' =>	'Other - ',
    'OTF' =>	'Other - Shipping and Handling',
    'OTFS' =>	'Other - Fuel Surcharge, Mileage',
    'OTME' =>	'Other Mobile Electronics',
    'OTML' =>	'Other - Mileage',
    'OTPB' =>	'Primary Tow Bill',
    'OTRS' =>	'Emergency Road Service',
    'OTSB' => 'Secondary Tow Bill',
    'OTSG' =>	'Other - Sublet Glass',
    'OTSL' =>	'Other - Sublet',
    'OTST' =>	'Other - Storage',
    'OTTL' =>	'Total Loss Settlement Charges',
    'OTTR' =>	'Temporary Repairs',
    'OTTW' =>	'Other - Towing',
    'OTUM' =>	'Other - Undercoating Materials',
    'PA' =>	'Parts',
    'PAA' =>	'Parts - Aftermarket (QRP)',
    'PAC' =>	'Parts - Rechromed',
    'PAG' =>	'Parts - Glass',
    'PAGD' =>	'Glass - Driver Side',
    'PAGF' =>	'Glass - Front',
    'PAGN' =>	'New Non-OEM Glass',
    'PAGP' =>	'Glass - Passenger Side',
    'PAGQ' =>	'Glass - Quarter Glass',
    'PAGR' =>	'Glass - Rear',
    'PAL' =>	'Parts - Like Kind and Quality (LKQ)',
    'PAM' =>	'Parts - Remanufactured',
    'PAMU' =>	'Parts - Used Mobile Electronics',
    'PAN' =>	'Parts - New',
    'PAND' =>	'Parts - New OEM discounted',
    'PANM' =>	'Parts - New Mobile Electronics',
    'PAO' =>	'Parts - Other',
    'PAR' =>	'Parts - Re-cored',
    'PASL' =>	'Parts - Sublet',
    'REFT' =>	'Refinish Total',
    'RLA' =>	'Labor - Related Prior Damage',
    'RLAB' =>	'Labor - Body Related Prior Damage',
    'RLAR' =>	'Labor - Refinish Related Prior Damage',
    'RPD' =>	'Related Prior Damage',
    'RPPA' =>	'Parts - Related Prior Damage',
    'SYS' =>	'System',
    'TOT' =>	'Total',
    'ULA' =>	'Labor - UnRelated Prior Damage',
    'ULAB' =>	'Labor - Body UnRelated Prior Damage',
    'ULAR' =>	'Labor - Refinish UnRelated Prior Damage',
    'UPD' =>	'Unrelated Prior Damage',
    'UPPA' =>	'Parts - UnRelated Prior Damage',
  ];

  public static $total_sub_type = [
    '1' =>	'Line Item Total',
    '18' =>	'Prepaid Items Amount',
    'AA' => 	'Appearance Allowance',
    'AAH' =>	'Replacement Amount',
    'ACU' =>	'Additional Clean Up',
    'Adjusted' =>	'Adjusted Price',
    'ADM' =>	'Administration fees',
    'ADV' =>	'Advance Amounts (e.g., court costs)',
    'AL' =>	'Additional Labor',
    'ALC' =>	'Advance Labor Charge',
    'AM' =>	'Additional Mileage',
    'ASL' =>	'On Site Labor',
    'ATP' =>	'Advance Towing Paid',
    'BM' => 'Adjustment',
    'BAS' =>	'Base Value',
    'BTR' =>	'Betterment',
    'CA' =>	'Core Adjustment',
    'CAN' =>	'Cancellation Charge',
    'CC' =>	'Core Charge',
    'CCS' =>	'Credit Card Surcharge',
    'CE' =>	'Summary Amount',
    'CON' =>	'Constant, constant painting charges',
    'CT' =>	'Change Tire',
    'CUST' =>	'Amount of Customer Payment',
    'D2' =>	'Deductible Amount',
    'D8' =>	'Discount Amount',
    'DLF' =>	'Dollies',
    'ECT' =>	'Subtotal',
    'ENV' =>	'Environmental Charge',
    'F7' =>	'Sales Tax',
    'FH' =>	'Fragile Handling Charge',
    'FL' =>	'Fluid Delivery' ,
    'FLS' =>	'Fuel Surcharges',
    'G' =>	'Gross' ,
    'GAT' =>	'Gate Fee is the cost to tow a vehicle to the gate of the storage location',
    'GST' =>	'Goods and Services Tax',
    'HM' =>	'Hazardous Materials Charge',
    'HRS' =>	'Hours',
    'HST' =>	'Harmonized Sales Tax',
    'IMP' =>	'Impound Fee',
    'INS' =>	'Insurance Charges',
    'JS' =>	'Jump Start',
    'LF' =>	'Lien Fee',
    'LO' =>	'Lock out is when a person is locked out of the vehicle',
    'LPC' =>	'Late Pickup Credit - Credit to seller for a late pickup by the pool from the initial storage location',
    'LS' =>	'Locksmith' ,
    'LST' =>	'Invoice List Price',
    'LUP' =>	'Lump sum total of the advance charges when provider will not itemize',
    'M8' =>	'Markup Amount',
    'MAN' =>	'Manual, charges that are from manual input',
    'Market' =>	'Market Value',
    'MATD' =>	'Material - Tire Disposal Fee',
    'MF' =>	'Mileage/Distance Fee - Based on Per Mile Amounts',
    'MFS' =>	'Mileage/Distance Fee - Fixed Amount',
    'MM' =>	'Mobile Mechanic' ,
    'ML' =>	'Prior Net Invoice Total',
    'MSC' =>	'Miscellaneous',
    'N' =>	'Net',
    'NF' =>	'Notification Fee',
    'ODPU' =>	'Document Pickup Fee',
    'OKPU' =>	'Key Pickup Fee',
    'ONIS' =>	'Storage fees assessed when the vehicle is stored by the tow provider due to the destination location being closed.  Non-impound storage fees',
    'OSA' =>	'Surcharge Amount',
    'OTAC' =>	'Additional Cost',
    'OTAD' =>	'Administration fee',
    'OTFO' =>	'Other - Freon & Oil',
    'OTHW' =>	'Other - Hazardous Wastes',
    'OTIF' =>	'Fees.  Fees assessed by a lot outside of the storage fees. These fees are to be able to remove the vehicle from the lot.   - fee other lot amount',
    'OTSI' =>	'Storage Lot Inside storage fees assessed by a lot.' ,
    'OTSO' =>	'Storage Lot Outside storage fees assessed by a lot.',
    'OTST' =>	'Storage.  Total storage fees assessed by a lot.' ,
    'OTTW' =>	'Towing  - fee towing amount.' ,
    'OVER' =>	'Oversized and/or Overweight Package Charges',
    'PN' =>	'Prior Gross Invoice Total',
    'PRE' =>	'Preservation',
    'R' =>	'Refund',
    'Retail' =>	'Total Retail Value',
    'RP' =>	'Repair',
    'SC' =>	'Street clean up, found on primary tows (e.g., glass, coolant, oil, gas clean up and any accident debris)' ,
    'SCF' =>	'Subrogation Current Fee Amount',
    'SCR' =>	'Subrogation Cost Recovered Amount (e.g., Court Costs)',
    'SDR' =>	'Subrogation Damages Recovered Amount',
    'SE' =>	'Special Equipment',
    'Settlement' =>	'Amount of Settlement',
    'SF' =>	'Service Fee',
    'SM' =>	'Supplemental',
    'Sold/List' =>	'Sold or Listed Price',
    'SPD' =>	'Special Delivery, including freight Charges',
    'SUB' =>	'Sublet',
    'SYS' =>	'System, source is from paint vendor systems',
    'T' =>	'Tax',
    'T2' =>	'Total Claim Before Taxes',
    'TAX' =>	'Use the Tax Code List',
    'TD' =>	'Total Distance',
    'TOW' =>	'Tow',
    'TT' =>	'Total Transaction Amount',
    'WARR' =>	'Warranty Charge',
    'WCH' =>	'Winching',
  ];

  public static $line_status = [
    '1' => 'Add',
    '2' => 'Change',
    '3' => 'Delete'
  ];

  public static $modifier = ['PAA' => 'A/M', 'PAND' => 'Opt OEM', 'PAM' => 'RECOND', 'PAL' => 'LKQ'];

  public static function access($type, $code)
  {
    if($code){
      if(array_key_exists($code, self::${$type})){
        return self::${$type}[$code];
      }
    }
    return null;
  }


}
 ?>
