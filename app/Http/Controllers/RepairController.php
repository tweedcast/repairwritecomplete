<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class RepairController extends Controller
{
    public function repair_list(Request $request, Location $location)
    {
      return $location->repairs->toJson();
    }
}
