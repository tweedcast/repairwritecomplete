<?php

namespace App\Services;

use App\Services\CreateUpdateRepairFile;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Repair;
use App\Helpers\DbaseParse;
use App\Events\Exported;
use Auth;

class ExportRepair
{
    use SerializesModels;
    private $repair;
    private $lines;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Repair $repair)
    {
      $this->repair = $repair;
      $this->lines = $repair->parts_lines;
    }




    public function process()
    {
      $parser = new DbaseParse(storage_path('app/' . $this->repair->line_file->file_loc));
      foreach($this->lines as $line){
        $row = $parser->findLine($line->unq_seq);
        if($row['index']){
          $row['line']['PART_TYPE'] = $line->n_part_type ? $line->n_part_type : $line->part_type;
          $row['line']['ACT_PRICE'] = $line->n_part_type ? $line->n_act_price : $line->act_price;
          $row['line']['LINE_DESC'] = $line->line_desc;
        }
        $parser->updateLine($row['index'], $row['line']);
      }
      $parser->close();
      DbaseParse::UpdateENVTime(storage_path('app/' . $this->repair->env_file->file_loc));
      $this->createDownloadPackage();
    }



    private function createDownloadPackage()
    {
      $package = [];
      foreach($this->repair->files as $file){
        $name = explode('_', $file->file_loc)[1];
        $new = ['tag' => $this->repair->file_tag, 'type' => $file->file_type, 'name' => $name];
        $package[] = $new;
      }
      Exported::dispatch($package, Auth::user()->uid);
    }

}

?>
