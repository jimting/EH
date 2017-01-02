<?php
include "mysqli_connect.inc.php";
//$equip_ID        =$_POST["equip_ID"];
$equip_name      =$_POST["equip_name"];
$equip_quantity  =$_POST["equip_quantity"];
//$equip_date      =$_POST["equip_date"];



$equip_date = date ("Y-m-d" , mktime(date('H')+8, date('i'))) ;

$sql = "insert into equipment (equip_name,equip_total,equip_quantity,equip_date) values ('$equip_name','$equip_quantity','$equip_quantity','$equip_date')";
mysqli_query($db,$sql);
?>