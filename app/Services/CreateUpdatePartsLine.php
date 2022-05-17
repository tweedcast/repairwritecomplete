<?php

namespace App\Services;


use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Repair;
use App\Models\PartsLine;
use App\Helpers\DbaseParse;
use App\Helpers\OperationCodes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;
use Session;
use Auth;

class CreateUpdatePartsLine
{
    use SerializesModels;
    private $file;
    private $repair;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Repair $repair, $file)
    {
        $this->repair = $repair;
        $this->file = $file;
        $this->codes = OperationCodes::$codes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function process()
    {
      $lines = DbaseParse::ParseLIN($this->file->getPathName());
      $this->checkRemoved($lines);
      $this->checkRevived($lines);
      foreach($lines as $line){
        $this->createUpdate($line);
      }
    }

    private function checkRemoved($lines)
    {
      $this->repair->load('parts_lines');
      $curr_lines = $this->repair->parts_lines;
      foreach($curr_lines as $curr){
        $found = false;
        foreach($lines as $line){
          if($curr->unq_seq == $line['UNQ_SEQ']){
            $found = true;
          }
        }
        if(!$found){
          $curr->delete();
        }
      }
    }

    private function checkRevived($lines)
    {
      foreach($lines as $line){
        $removed = $this->repair->check_removed($line['UNQ_SEQ']);
        if($removed){
          $removed->restore();
        }
      }
    }

    private function createUpdate($line)
    {
      $data = [
        'line_no' => $line['LINE_NO'],
        'orig_desc' => trim($line['LINE_DESC']),
        'part_type' => trim($line['PART_TYPE']),
        'oem_partno' => trim($line['OEM_PARTNO']),
        'act_price' => trim($line['ACT_PRICE']),
        'lbr_op' => trim($line['LBR_OP']),
        'lbr_op_desc' => $this->codes[trim($line['LBR_OP'])],
      ];



      $parts_line = PartsLine::updateOrCreate(
            ['repair_id' => $this->repair->id, 'unq_seq' => $line['UNQ_SEQ']],
            $data
        );
        self::normalize($parts_line);
        self::updateDesc($parts_line);
    }

    public static function normalize(PartsLine $line)
    {
      $data = [];
      if($line->act_price > 0){
        if($line->part_type == 'PAN'){
          if($line->n_part_type != "PAN"){
            $modifier = OperationCodes::check_modifier($line->line_desc, $line->n_part_type);
            if($modifier){
              $discount = $line->repair->shop->discount($modifier);
              $n_price = $line->act_price - round($line->act_price * $discount->discount, 2);
              if($discount->round){
                $n_price = self::round_price($n_price);
              }
              $data["n_act_price"] = $n_price;
            }
          }
          if($line->n_part_type == $line->part_type){
            $data['n_part_type'] = null;
            $data['n_act_price'] = $line->act_price;
          }
        } else {
          $data['n_act_price'] = $line->act_price;
        }
      }
      $line->update($data);
      self::check_switch_back($line);
    }

    private static function check_switch_back(PartsLine $line)
    {
      if($line->n_part_type){
        if($line->n_act_price < 5){
          $line->update([
            'n_part_type' => null,
            'n_act_price' => $line->act_price,
            'line_desc' => $line->orig_desc
          ]);
        }
      }

      return;
    }

    private static function round_price($price)
    {
      if($price > 1000){
        return floor($price / 10) * 10;
      }

      if($price > 100){
        return floor($price / 5) * 5;
      }

      return floor($price);
    }

    public static function updateDesc(PartsLine $line){
      if(is_null($line->n_part_type)){
        $line->update(['line_desc' => $line->orig_desc]);
      }
    }

    public static function update(PartsLine $line, $request)
    {
      if($line->part_type != 'PAS' && $line->act_price > 0) {
        $curr_code = $line->n_part_type ? $line->n_part_type : $line->part_type;
        $n_desc = OperationCodes::remove_modifier($line->line_desc, $curr_code);
        $n_desc = OperationCodes::prepend($n_desc, $request->modifier);
        $data = [$request->change => $request->value, 'line_desc' => $n_desc];
        $line->update($data);
        self::normalize($line);
      }
    }

    public static function reset(PartsLine $line)
    {
      $line->update(['n_part_type' => null, 'n_act_price' => $line->act_price, 'line_desc' => $line->orig_desc]);
    }


}

?>
