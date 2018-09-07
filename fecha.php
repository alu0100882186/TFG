<?php
$val1 = '2014-03-18 10:34:09.939';
$val2 = '2014-03-18 10:39:09.940';

$datetime1 = new DateTime($val1);
$datetime2 = new DateTime($val2);
echo "<pre>";
var_dump($datetime1->diff($datetime2));

if($datetime1 > $datetime2)
  echo "1 is bigger";
else
  echo "2 is bigger";


   $nInterval = strtotime($val2) - strtotime($val1);
   $nInterval = $nInterval/60;

   echo " Esto vale la resta:" .$nInterval;


?>
