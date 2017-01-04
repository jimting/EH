<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="./toastr.js"></script>
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="toastr.css" type="text/css" media="screen" />
		<img src="./image/BigTitle.jpg" class="BigTitle" />
		<nav class="navbar navbar-default" style="border-radius:10px;">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button> 
				<a class="navbar-brand" href="index.html">課指組器管屋(´・ω・`)</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="index.html">回首頁</a></li>
					<li><a href="users.php">學生總表</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">器材教室區<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="equipments.php">器材使用列表</a></li>
							<li><a href="classroom.php">教室使用列表</a></li>
						</ul>
					</li>
					<li>
						<a href='notice.php'>違規提醒專區</a>
					</li>
					<li>
						<a href='logout.php'>登出</a>
					</li>
					<li>
						<iframe src="headerinfo.php" width="200px" height="50px" frameborder="0" scrolling="no"></iframe>
					</li>
				</ul>
				<div class="design">
					<a href="http://www.stu.ntou.edu.tw/sc/" target="_blank"><p>國立臺灣海洋大學學生活動中心/課外活動指導組 器材借用網</p></a>
					<a target="_blank" href="https://www.facebook.com/IMJimmyLin"><p>Web Design by JT</p></a>
				</div>
			</div>
		</nav>
		<script>
			toastr.options = {
				positionClass: 'toast-bottom-right',
			}
			$(document).ready(function()
			{
				$("#updatebutton").click(function()
				{
					$.post("update_userinfo_finish.php",
					{
						user_number:		$('#user_number').val(),
						user_pw:			$('#user_pw').val(),
						user_pw2:			$('#user_pw2').val(),
						user_nickname:		$('#user_nickname').val(),
						user_email:			$('#user_email').val(),
						user_department:	$('#user_department').val(),
						user_phone:			$('#user_phone').val()
					},
					function(result){
						toastr.success('<strong>修改成功啦！</strong><br>可以到個人資訊確認<br>轉跳到個人資訊！');
						setTimeout("location.href='userinfo.php'",2000);
					});
				});
			});
			
		</script>
	</head>
	<body>
		<div class="container">
			<h1>您好！以下是你的個人資料！</h1>       
			<table class="table table-hover">
				<?php
				include("mysqli_connect.inc.php");
				
				$user_ID = $_SESSION['user_ID'];
				$CheckPassword = $_POST['CheckPassword'];
				$sql = "SELECT * FROM user WHERE user_ID = '$user_ID'";
				if($stmt = $db->query($sql))
				{
					while($result = mysqli_fetch_object($stmt))
					{
						if($user_ID == $result->user_ID && $CheckPassword == $result->user_pw)
						{
							echo '學號：<input type="text" class="form-control" id ="user_number" value="'.$result->user_number.'(此項目無法修改)" disabled /> <br>';
							echo '密碼：<input type="password" class="form-control" id="user_pw" value="'.$result->user_pw.'" /> <br>';
							echo '再一次輸入密碼：<input type="password" class="form-control" id="user_pw2" value="'.$result->user_pw.'" /> <br>';
							echo '暱稱：<input type="text" class="form-control" id="user_nickname" value="'.$result->user_nickname.'" /> <br>';
							echo 'Email：<input type="text" class="form-control"  id="user_email" value="'.$result->user_email.'" /> <br>';
							echo '所屬社團/工作單位：<input type="text" class="form-control" id="user_department" value="'.$result->user_department.'"/> <br>';
							echo '連絡電話：<input type="text" class="form-control" id="user_phone" value="'.$result->user_phone.'"/> <br>';
							echo '<a id="updatebutton" class="btn btn-default" name="button">確定修改</a>';
						}
						else
						{
							echo "<h1>密碼錯誤！請重新確認後再試一次！</h1>";
							echo '<script>setTimeout("history.go(-1)",2000);</script>';
							
						}
					}
				}
				?>
			</table>
		</div>
	</body>
</html>