<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BMSImportController extends Controller
{
    public function import(Request $request)
    {
      return 'ok';
    }


    public function ping()
    {
      return Carbon::now('UTC')->toISOString();
    }
}
