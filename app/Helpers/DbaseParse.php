<?php
namespace App\Helpers;

use App\Helpers\OperationCodes;

class DbaseParse {
  private $db;
  private $count;
  private $lines;

  public function __construct($file)
  {
    $this->db = dbase_open($file, 2);
    $this->count = dbase_numrecords($this->db);
  }

  public static function ParseENV($file){
    $db = dbase_open($file, 0);
    return dbase_get_record_with_names($db, 1);
  }

  public static function ParseVEH($file){
    $db = dbase_open($file, 0);
    return dbase_get_record_with_names($db, 1);
  }

  public static function ParseAD1($file){
    $db = dbase_open($file, 0);
    return dbase_get_record_with_names($db, 1);
  }


  public static function ParseLIN($file){
    $db = dbase_open($file, 0);
    $lines = dbase_numrecords($db);
    $parts = [];
    for($i = 1; $i <= $lines; $i++){
      $line = dbase_get_record_with_names($db, $i);
        $parts[$i] = $line;
    }
    return $parts;
  }

  public static function ParsePFL($file){
    $db = dbase_open($file, 0);
    $lines = dbase_numrecords($db);
    $rates = [];
    for($i = 1; $i <= $lines; $i++){
      $line = dbase_get_record_with_names($db, $i);
        $rates[$i] = $line;
    }
    return $rates;
  }

  public static function ParseSTL($file){
    $db = dbase_open($file, 0);
    $lines = dbase_numrecords($db);
    $total = [];
    for($i = 1; $i <= $lines; $i++){
      $line = dbase_get_record_with_names($db, $i);
        $total[trim($line['TTL_TYPECD'])] = $line;
    }

    return $total;
  }

  public static function ParseTTL($file){
    $db = dbase_open($file, 0);
    $lines = dbase_numrecords($db);
    $total = [];
    for($i = 1; $i <= $lines; $i++){
      $line = dbase_get_record_with_names($db, $i);
        $total[$i] = $line;
    }
    return $total;
  }

  public function findLine($unq)
  {
    $index = 0;

    for($i = 1; $i <= $this->count; $i++){
      $line = dbase_get_record_with_names($this->db, $i);
      if($line['UNQ_SEQ'] == $unq){
        $index = $i;
        break;
      }
      $line = null;
    }
    if($line){
      unset($line['deleted']);
    }
    return ['index' => $index, 'line' => $line];
  }

  public function updateLine($index, $line)
  {
    $line = array_values($line);
    dbase_replace_record($this->db, $line, $index);
  }

  public static function UpdateENVTime($file){
    $db = dbase_open($file, 2);
    $record = dbase_get_record_with_names($db, 1);
    unset($record['deleted']);
    $record['CREATE_DT'] = \Carbon\Carbon::now()->format('Ymd');
    $record['CREATE_TM'] = \Carbon\Carbon::now()->format('His');
    $record = array_values($record);
    dbase_replace_record($db, $record, 1);
  }

  public function close()
  {
    dbase_close($this->db);
  }

}
 ?>
