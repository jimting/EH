<?php session_start(); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</head>
	<body>
		<?php
		include("mysqli_connect.inc.php");

		$room_ID = $_POST['classroom'];
		$user_ID = $_SESSION['user_ID'];

		if($user_ID != null && $room_ID != null)
		{
				//新增資料進資料庫語法
				$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
				$sql = "insert into lend_room (user_ID,room_ID,lend_date) values ('$user_ID','$room_ID','$datetime')";
				if(mysqli_query($db,$sql))
				{
					$sql2 = "update classroom set room_status = 1 where room_ID = '$room_ID'";
					if(mysqli_query($db,$sql2))
					{
						echo '借用教室成功!';
					}
					else
					{
						echo '借用教室失敗1!';
					}				
				}
				else
				{
						echo '借用教室失敗2!';
				}
		}
		else
		{
				echo '您無權限觀看此頁面!';
		}
		?>
	</body>
</html>