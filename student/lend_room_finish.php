<?php session_start(); ?>
<?php
	include("mysqli_connect.inc.php");

	$user_ID = $_SESSION['user_ID'];
	$room_ID = $_POST['room_ID'];
	$lend_date = $_POST['lend_date'];
	$lend_time = $_POST['lend_time'];
	
	$sql = "INSERT INTO lend_room (user_ID, room_ID,lend_date,lend_time) values ('$user_ID', '$room_ID','$lend_date','$lend_time')";
	mysqli_query($db,$sql);
?>