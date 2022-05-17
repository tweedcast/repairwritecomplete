<?php

namespace App\Services;

use App\Services\FileCreateRepair;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Models\Repair;
use App\Models\RepairFile;
use App\Jobs\CreateRepair;
use App\Jobs\UpdateRepair;

class DirectFile
{
    private $file;
    private $uid;
    private $type;
    private $tag;
    private $og_name;
    private $repair_file;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $uid)
    {
        $this->file = $file;
        $this->uid = $uid;
        self::getFileInfo();
    }

    private function getFileInfo(){
      $this->og_name = $this->file->getClientOriginalName();
      $this->type = strtolower(pathinfo($this->og_name, PATHINFO_EXTENSION));
      $this->tag = rtrim(pathinfo($this->og_name, PATHINFO_FILENAME), "ABV");
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    private function store()
    {

        $r_exists = Repair::exists(Auth::user()->id, $this->tag);

        if($r_exists){
          $stage = 'files';
          $store = Storage::putFileAs($stage, $this->file, $this->uid . '_' . $this->og_name);
          $data = ['file_name' => $store, 'stage' => $stage, 'last_upload' => \Carbon\Carbon::now(), 'repair_id' => $r_exists->id];
        } else {
          $stage = 'queue';
          $store = Storage::putFileAs($stage, $this->file, $this->uid . '_' . $this->og_name);
          $data = ['file_name' => $store, 'stage' => $stage, 'last_upload' => \Carbon\Carbon::now()];
        }

        $this->repair_file = RepairFile::updateOrCreate(
                          ['user_id' => Auth::user()->id, 'file_tag' => $this->tag, 'file_type' => $this->type],
                          $data
                      );
    }


    public function direct()
    {
      $this->store();
      if(strtolower($this->type) == 'env' || strtolower($this->type) == 'veh'){
        $create = new FileCreateRepair($this->repair_file);
        $create->process();
      }

      if(strtolower($this->type) == 'lin'){

      }
      return $this->repair_file;
    }


    public static function attachFile(RepairFile $file, $r_id)
    {
      if($file->stage == 'queue'){
        $new_name = 'files/' . explode('/', $file->file_name)[1];
        Storage::move($file->file_name, $new_name);
        $file->update([
          'stage' => 'files',
          'file_name' => $new_name,
          'repair_id' => $r_id,
        ]);
      }
    }


}

?>
