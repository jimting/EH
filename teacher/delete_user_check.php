<?php session_start(); ?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
	</head>
	<body>
		<?php
		include("mysqli_connect.inc.php");
		$id = $_GET['id'];

		if($_SESSION['user_number'] != null)
		{
				//刪除資料庫資料語法
				$sql = "SELECT * from user where user_ID='$id'";
				$stmt = $db->query($sql);
				$result=mysqli_fetch_object($stmt);
				if($result != null)
				{
					echo "<h1>確定要刪除".$result->user_department."的".$result->user_nickname."嗎？</h1>";
					echo "<a href='delete_user_finish.php?id=".$result->user_ID."' class='btn btn-lg btn-default'>確定要刪除</a><a onclick=history.back() class='btn btn-lg btn-default'>回到上一頁</a>";
				}
		}
		else
		{
				echo '您無權限觀看此頁面!';
				echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
		}
		?>
	</body>
</html>