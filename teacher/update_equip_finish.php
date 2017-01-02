<?php
include "mysqli_connect.inc.php";

$equip_name      =$_POST["equip_name"];
$equip_total  =$_POST["equip_total"];
$equip_quantity  =$_POST["equip_quantity"];

//$sql = "insert into equipment (equip_name,equip_quantity,equip_date) values ('$equip_name','$equip_quantity','$equip_date')";

$sql = "update equipment set equip_quantity ='$equip_quantity',equip_name = '$equip_name',equip_total = '$equip_total' where equip_name='$equip_name'";
mysqli_query($db,$sql);
?>