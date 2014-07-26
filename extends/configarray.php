<?php
include(__DIR__.'/../fusearray.php');

class ConfigArray extends FuseArray {
  
  public static function ConvertIni($iniData, $fuseOut = true) {
    if(is_file($iniData)) {
      $iniData = parse_ini_file($iniData, true);
    }
    $class = get_called_class();
    $array = new $class();
    if(is_array($iniData) || ($iniData instanceof FuseArray)) {
      foreach($iniData as $section => $values) {
        if(is_array($values) || ($values instanceof FuseArray)) {
          foreach($values as $key => $value) {
            $array->Set($section.'.'.$key, $value, $fuseOut);
          }
        }
      }
    }
    return $array;
  }
  
  public function ImportIni($iniData, $fuseOut = true) {
    if(is_file($iniData)) {
      $iniData = parse_ini_file($iniData, true);
    }
    if(is_array($iniData) || ($iniData instanceof FuseArray)) {
      foreach($iniData as $section => $values) {
        if(is_array($values) || ($values instanceof FuseArray)) {
          foreach($values as $key => $value) {
            $this->Set($section.'.'.$key, $value, $fuseOut);
          }
        }
      }
    }
    return $this;
  }
  
}
