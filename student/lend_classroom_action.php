<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");

$lend_date = $_POST['startdays'];
$room_ID = $_POST['classroom'];
$lend_time = $_POST['time'];//預借時段
$user_ID = $_SESSION['user_ID'];

if($lend_date != null && $room_ID != null && $lend_time != null && $user_ID != null && $room_ID != null)
{
    $sql_check = "SELECT * FROM lend_room WHERE lend_date ='$lend_date' AND room_ID ='$room_ID' AND lend_time = '$lend_time'";
	if($stmt = $db->query($sql_check))
	{
		if($result=mysqli_fetch_object($stmt))
		{
			echo '該時段無法預借';
		}
		else
		{
			$sql = "insert into lend_room (user_ID,room_ID,lend_date,lend_time) values ('$user_ID','$room_ID','$lend_date','$lend_time')";
			if(mysqli_query($db,$sql))
			{
				echo '借用教室成功!';
			}
			else
			{
				echo '借用教室失敗!';
			}
		}
	}
}
else
{
    echo '您無權限觀看此頁面!';
}
?>