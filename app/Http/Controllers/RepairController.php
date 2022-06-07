<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Organization;
use App\Models\Location;
use App\Models\Repair;
use App\Models\Line;

class RepairController extends Controller
{

    public function repair_review_show(Organization $organization, Location $location, Repair $repair)
    {
      return Inertia::render('RepairReview',
      [
        'repair' => $repair,
      ]);
    }

    public function repair_list(Request $request, Location $location)
    {
      return $location->repairs->toJson();
    }

    public function get_repair_lines(Request $request)
    {
      $lines = Line::where('repair_id', $request->repair_id)->get();
      foreach($lines as $line){
        $mods = $line->modifications;
        $mods = $mods->groupBy('type');
        $line->setRelation('modifications', $mods);
      }
      return $lines;
    }

    public function get_repair_options(Request $request)
    {
      $repair = Repair::find($request->repair_id);

      $opts = $repair->options;

      $opt_count = count($opts);
      $opts = $opts->groupBy(function($opt){
        return $opt->grp_description;
      });
      $grp_count = count($opts);
      $total = $opt_count + $grp_count;
      $split = ceil($total / 3);
      $flatten = [];

      foreach($opts as $grp => $opt){
        $flatten[] = ['G', $grp];
        foreach($opt as $op){
          $flatten[] = ['O', $op->option_desc];
        }
      }
      $layout = array_chunk($flatten, $split);

      return ['options' => $opts, 'layout' => $layout];
    }


    public function get_repair_totals(Request $request)
    {
        $repair = Repair::find($request->repair_id);

        return [
          'labor_rates' => $repair->labor_rates(),
          'material_rates' => $repair->material_rates(),
          'part_rates' => $repair->part_rates(),
          'tax_rate' => $repair->tax_rate(),
          'subtotals' => $repair->subtotals(),
          'totals' => $repair->totals()];
    }
}
