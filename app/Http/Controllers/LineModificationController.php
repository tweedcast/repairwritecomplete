<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineModification;

class LineModificationController extends Controller
{
  public function add(Request $request)
  {
    LineModification::updateOrCreate([
      'line_id' => $request->line_id,
      'type' => $request->type,
    ],
    [
      'value' => $request->value ? $request->value : ' ',
      'doc_code' => $request->doc_code,
      'doc_ver' => $request->doc_ver,
      'line_ver' => $request->line_ver,
    ]);

    return 'ok';
  }

  public function remove(Request $request)
  {
    LineModification::find($request->mod_id)->delete();
    return 'ok';
  }
}
