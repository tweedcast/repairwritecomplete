<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CCCBmsImport;

class BMSImportController extends Controller
{
    public function ccc_import(Request $request)
    {

      $import = new CCCBmsImport($request->getContent());
      if($import->check_location()){
        return $import->process();
      }
      return 'fail';
    }


    public function ping()
    {
      return \Carbon\Carbon::now('UTC')->toISOString();
    }
}
