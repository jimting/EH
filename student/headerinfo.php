<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="headerinfo.css" type="text/css" media="screen" />
<?php
	//連接資料庫
	//只要此頁面上有用到連接MySQL就要include它
	include("mysqli_connect.inc.php");
    echo '<span class="info">您好！<span class="usernickname">'.$_SESSION['user_nickname'].'</span><br><a href="userinfo.html" class="ToUserinfo" target="_parent">→點我進入個人資訊</a></span>';
?>