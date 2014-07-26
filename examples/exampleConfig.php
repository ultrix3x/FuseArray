<?php
include('../extends/configarray.php');

$config = ConfigArray::ConvertIni('./exampleConfig.ini');
foreach($config as $key => $value) {
  echo $key.' - '.$value.PHP_EOL;
}
