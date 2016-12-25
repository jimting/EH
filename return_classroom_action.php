<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");

$room_ID = $_POST['classroom'];
$user_ID = $_SESSION['user_ID'];

if($user_ID != null && $room_ID != null)
{
        $sql = "DELETE FROM lend_room WHERE room_ID = '$room_ID' AND user_ID = '$user_ID'";
        if(mysqli_query($db,$sql))
        {
			$sql2 = "update classroom set room_status = 0 where room_ID = '$room_ID'";
			if(mysqli_query($db,$sql2))
			{
				echo '歸還教室成功!';
			}
			else
			{
				echo '歸還教室失敗1!';
			}				
        }
        else
        {
                echo '歸還教室失敗2!';
        }
}
else
{
        echo '您無權限觀看此頁面!';
}
?>