<?php

namespace App\Services;


use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\RepairFile;
use App\Models\Repair;
use App\Helpers\DbaseParse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;
use Auth;

class CreateUpdateRepairFile
{
    use SerializesModels;
    private $files;
    private $repair;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Repair $repair, $files)
    {
        $this->repair = $repair;
        $this->files = $files;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function process()
    {
      foreach($this->files as $type => $file){
        $path = $this->storeFile($type, $file);
        $repair_file = $this->createUpdate($type, $path);
      }
    }

    private function storeFile($type, $file)
    {
      $og_name = $file->getClientOriginalName();
      $path = Storage::putFileAs('files', $file, Auth::user()->shop->uid . '_' . $og_name);
      return $path;
    }

    private function createUpdate($type, $path)
    {
      $data = ['file_loc' => $path, 'last_upload' => \Carbon\Carbon::now(), 'repair_id' => $this->repair->id, 'shop_id' => Auth::user()->shop->id];
      $repair_file = RepairFile::updateOrCreate(
            ['user_id' => Auth::user()->id, 'file_tag' => $this->repair->file_tag, 'file_type' => $type],
            $data
        );
    }

}

?>
