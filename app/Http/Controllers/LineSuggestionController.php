<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineSuggestion;

class LineSuggestionController extends Controller
{
    public function add(Request $request)
    {
      LineSuggestion::create([
        'line_id' => $request->line_id,
        'description' => $request->description,
        'doc_code' => $request->doc_code,
        'doc_ver' => $request->doc_ver,
        'line_ver' => $request->line_ver,
      ]);

      return 'ok';
    }

    public function remove(Request $request)
    {
      LineSuggestion::find($request->sugg_id)->delete();
      return 'ok';
    }

}
