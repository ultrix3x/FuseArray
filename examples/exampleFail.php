<?php
include('../fusearray.php');

$fuse = FuseArray::Convert(array(1,2,3,4));

array_shift($fuse); // Fails since fuse is an object and not an array

foreach($fuse as $key => $value) {
  echo $key.' - '.$value.PHP_EOL;
}
