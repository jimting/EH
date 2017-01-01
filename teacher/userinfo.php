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
					<li class="active"><a href="index.html">回首頁</a></li>
					<li><a href="users.php">管理學生</a></li>
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
			<h1>您好！以下是你的個人資料！</h1>            
			<table class="table table-hover">
				<?php
				include("mysqli_connect.inc.php");
				$temp = $_SESSION['user_ID'];
				//此判斷為判定觀看此頁有沒有權限
				//說不定是路人或不相關的使用者
				//因此要給予排除
				if($_SESSION['user_number'] != null)
				{
					 echo '<tr><td>你的學號：</td><td>'.$_SESSION['user_number'].'</td></tr><tr><td>你的暱稱：</td><td>'.$_SESSION['user_nickname'].'</td></tr><tr><td>你隸屬的社團：</td><td>'.$_SESSION['user_department'].'</td></tr><tr><td>帳號創建日期：</td><td>'.$_SESSION['user_date'].'</td></tr>';
					 $sql = "SELECT *
						FROM equipment AS A1, lend_equip AS A2
						WHERE A1.equip_ID = A2.equip_ID AND A2.user_ID = '$temp'";
					 if($stmt = $db->query($sql))
					 {
						 echo '<tr><td><h1>以下是尚未歸還之器材</h1></td></tr>';
						 while($result=mysqli_fetch_object($stmt)){
							echo '<tr><td>'.$result->equip_name.'</td><td>預借日期'.$result->lend_date.'，借'.$result->lend_days.'天</td></tr>';
						 }
					 }
					$sql = "SELECT *
						FROM classroom AS A1, lend_room AS A2
						WHERE A1.room_ID = A2.room_ID AND A2.user_ID = '$temp'";
					 if($stmt = $db->query($sql))
					 {
						 echo '<tr><td><h1>以下是尚未歸還之教室</h1></td></tr>';
						 while($result2=mysqli_fetch_object($stmt)){
							echo '<tr><td>'.$result2->room_name.'</td><td>預借日期'.$result2->lend_date.'</td></tr>';
						 }
					 }
				}
				else
				{
						echo '您無權限觀看此頁面!';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
				}
				?>
			</table>
		</div>
	</body>
</html>