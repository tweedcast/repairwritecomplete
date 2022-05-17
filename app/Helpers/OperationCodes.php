<?php
namespace App\Helpers;

class OperationCodes {

  public static $oper_desc = [
    'OP11' => 'Replace',
    'OP12' => 'Replace',
    'OP24' => 'Chip Guard',
    'OP25' => 'Two Tone',
    'OP26' => 'Paintless Dent Repair',
    'OP3' => 'Additional Repair',
    'OP4' => 'Alignment',
    'OP5' => 'Overhaul',
    'OP6' => 'Refinish',
    'OP7' => 'Inspect',
    'OP8' => 'Check/Adjust',
    'OP9' => 'Repair',
    'OP0' => 'Blank',
    'OP1' => 'Refinish/Repair',
    'OP10' => 'Repair, Partial',
    'OP11' => 'Remove/Replace',
    'OP12' => 'Remove/Replace, Partial',
    'OP13' => 'Additional Costs',
    'OP14' => 'Additional Operations',
    'OP15' => 'Blend',
    'OP16' => 'Sublet',
    'OP17' => 'Related Prior Damage',
    'OP18' => 'Appearance Allowance',
    'OP19' => 'Unrelated Prior Damage',
    'OP2' => 'Remove/Install',
    ];

  public static $labor_type = [
    'LAB' => 'Body',
    'LABA' => 'Body, Additional Labor',
    'LABS' => 'Body, Sublet',
    'LAD' => 'Diagnostic',
    'LADT' => 'Drill Time',
    'LAE2' => '2 stage edge',
    'LAE' => 'Electrical',
    'LAET' => 'Edging Time',
    'LAF' => 'Frame',
    'LAFA' => 'Frame, Additional Labor',
    'LAFS' => 'Frame, Sublet',
    'LAG' => 'Glass',
    'LAGA' => 'Glass, Additional Labor',
    'LAGS' => 'Glass, Sublet',
    'LAI' => 'Installation & Wiring',
    'LAM' => 'Mechanical',
    'LAMA' => 'Mechanical, Additional Labor',
    'LAMS' => 'Mechanical, Sublet',
    'LAR' => 'Refinish',
    'LARA' => 'Refinish, Additional Labor',
    'LARS' => 'Refinish, Sublet',
    'LAS' => 'Structural',
    'LASA' => 'Structural, Additional Labor',
    'LASS' => 'Structural, Sublet',
    'LASU' => 'Surface',
    'LAUT' => 'Underside Time',
  ];

  public static $sub_total_type = [
    'MAT' => 'Paint & Materials',
    'PAT' => 'Parts',
    'LAB' => 'Body Labor',
    'LAR' => 'Refinish Labor',
    'LAM' => 'Mechanical Labor',
    'LAS' => 'Structural Labor',
    'LAF' => 'Frame Labor',
    'LAS' => 'Sublet Labor',
    'LAD' => 'Diagnostic Labor',
    'LAE' => 'Electrical Labor',
    'LAG' => 'Glass Labor',
  ];



  public static $modifier = ['PAA' => ['A/M'], 'PAM' => ['RECOND', 'Opt OEM'], 'PAL' => ['LKQ'], 'PAN' => ['OEM']];

  public static function remove_modifier($desc, $code)
  {
    foreach(self::$modifier[$code] as $mod){
      if(str_contains($desc, $mod)){
        $str = explode($mod, $desc)[1];
        $str = trim($str);
        return $str;
      }
    }
    return $desc;
  }

  public static function prepend($line, $modifier)
  {
    $new = trim($line);
    $new = $modifier . ' ' . $new;
    return $new;
  }

  public static function check_modifier($desc, $code)
  {
    if(array_key_exists($code, self::$modifier)){
      foreach(self::$modifier[$code] as $mod){
        if(str_contains($desc, $mod)){
          return $mod;
        }
      }
    }

    return null;
  }


}
 ?>
