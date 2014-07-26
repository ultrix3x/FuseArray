<?php
include('../fusearray.php');

$arr = FuseArray::Convert(array(1,2,3,4));
foreach($arr as $key => $value) {
  echo $key.' - '.$value.PHP_EOL;
}
