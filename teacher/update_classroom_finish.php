<?php
include "mysqli_connect.inc.php";

$room_ID = $_POST['room_ID'];
$room_name      =$_POST["room_name"];

$sql = "update classroom set room_name = '$room_name' where room_ID='$room_ID'";
mysqli_query($db,$sql);
?>