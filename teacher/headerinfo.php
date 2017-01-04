<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="headerinfo.css" type="text/css" media="screen" />
<?php
	//連接資料庫
	//只要此頁面上有用到連接MySQL就要include它
	include("mysqli_connect.inc.php");
	if($_SESSION['user_ID'] == null)
	{
		echo '<script>history.go(-1)</script>';
	}
	else
	{
		$user_ID = $_SESSION['user_ID'];
		$sql = "SELECT * FROM user WHERE user_ID = '$user_ID'";
		if($stmt = $db->query($sql))
		{
			while($result = mysqli_fetch_object($stmt))
			{
				echo '<span class="info">您好！<span class="usernickname">'.$result->user_nickname.'</span><br><a href="userinfo.php" class="ToUserinfo" target="_parent">→點我進入個人資訊</a></span>';
			}
			
		}
	}
?>