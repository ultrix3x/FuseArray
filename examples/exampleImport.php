<?php
include('../fusearray.php');

$arr = new FuseArray();
$arr->Import(array(1,2,3,4));
foreach($arr as $key => $value) {
  echo $key.' - '.$value.PHP_EOL;
}
