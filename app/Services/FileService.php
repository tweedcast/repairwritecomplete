<?php

namespace App\Services;


use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Repair;
use App\Helpers\DbaseParse;
use Illuminate\Support\Facades\Storage;
use Auth;

class FileService
{
    private $file;
    private $path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
      $this->file = $file;
    }

    private function process()
    {

    }

    private function store_file($type, $file)
    {
      $og_name = $file->getClientOriginalName();
      $path = Storage::putFileAs('files', $file, Auth::user()->shop->uid . '_' . $og_name);
      $this->path = $path;
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
