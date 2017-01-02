<?php
include "mysqli_connect.inc.php";
$room_name      =$_POST["room_name"];

$room_date = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;

$sql = "insert into classroom (room_name,room_status,room_date) values ('$room_name',0,'$room_date')";
mysqli_query($db,$sql);
?>