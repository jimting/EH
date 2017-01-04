<?php session_start(); ?>
<?php
	include("mysqli_connect.inc.php");
	if($_SESSION['user_ID'] != null)
	{
		$lend_room_ID = $_POST['lend_room_ID'];
		$lend_time = $_POST['lend_time'];
		$user_ID = $_SESSION['user_ID'];

		$sql = "DELETE FROM lend_room WHERE lend_room_ID = '$lend_room_ID' AND user_ID = '$user_ID' AND lend_time = '$lend_time'";
		mysqli_query($db,$sql);
		
		echo "還教室成功囉";
	}
	else
	{
		echo "無權限使用此網頁！";
	}
?>