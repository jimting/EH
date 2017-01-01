<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)-學生總表</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
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
					<li class="active"><a href="users.php">管理學生</a></li>
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
	</head>
	<body>
		<div class="container">
			<?php
				include('mysqli_connect.inc.php');
				if($_SESSION['user_number'] != null)
				{
						//將$_SESSION['id']丟給$id
						//這樣在下SQL語法時才可以給搜尋的值
						$id = $_GET['id'];
						//若以下$id直接用$_SESSION['username']將無法使用
						$sql = "SELECT * FROM user where user_id = '$id'";
						$stmt = $db->query($sql);
						$result=mysqli_fetch_object($stmt);
					
						echo '<form name="form" method="post" action="update_user_finish.php">';
						echo '學號：<input type="text" name="id" value="'.$result->user_number.'" />(此項目無法修改) <br>';
						echo '密碼：<input type="text" name="pw" value="'.$result->user_pw.'" /> <br>';
						echo '再一次輸入密碼：<input type="text" name="pw2" value="'.$result->user_pw.'" /> <br>';
						echo '暱稱：<input type="text" name="nickname" value="'.$result->user_nickname.'" /> <br>';
						echo 'Email：<input type="text" name="email" value="'.$result->user_email.'" /> <br>';
						echo '所屬社團/工作單位：<input type="text" name="department" value="'.$result->user_department.'"/> <br>';
						echo '連絡電話：<input type="text" name="phone" value="'.$result->user_phone.'"/> <br>';
						echo '等級：<input type="text" name="phone" value="'.$result->user_level.'"/> <br>';
						echo '<input type="submit" name="button" value="確定修改" />';
						echo '</form>';
				}
				else
				{
						echo '您無權限觀看此頁面!';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
				}
			?>
		</div>
	</body>
</html>