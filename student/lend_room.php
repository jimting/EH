<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)-預借教室</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="./datepicker.js"></script>
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
	</head>
	<body>
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
					<li><a class="dropdown-toggle" data-toggle="dropdown" href="#">借還教室<span class="caret"></a>
						<ul class="dropdown-menu">
							<li><a href="lend_room.php">我要預借教室</a></li>
							<li><a href="return_room.php">我要還教室</a></li>
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
		<div class="container">
			<form action='lend_classroom_action.php' method ='post'>
				<div class="form-group">
					<label>預借日期:</label>
					<input id="datepicker" class="form-control" name="startdays"/>
					<label for="classroom">選擇教室:</label>
					<select name="classroom">
						<?php
							include "mysqli_connect.inc.php";
							$query = "SELECT * FROM classroom";
							if($stmt = $db->query($query))
							{
								while($result=mysqli_fetch_object($stmt))
								{
									echo "<option value=".$result->room_ID.">".$result->room_name."</option>";
								}
							}
						?>
					</select><br>
					<label for="time">預借時段:</label>
					<select name="time">
						<option value ="0">9~11</option>
						<option value ="1">11~13</option>
						<option value ="2">13~15</option>
						<option value ="3">15~17</option>
					</select><br>
				</div>
				<button type='submit' class='btn btn-default'>確認</button>
			</form>
		</div>
	</body>
</html>