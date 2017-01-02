<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)-歸還器材</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
		<script src="Phone.js"></script>
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
					<li class="active"><a href="index.html">回首頁</a></li>
					<li><a href="users.php">學生總表</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">器材教室區<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="equipments.php">器材使用列表</a></li>
							<li><a href="classroom.php">教室使用列表</a></li>
						</ul>
					</li>
					<li><a class="dropdown-toggle" data-toggle="dropdown" href="#">借還器材<span class="caret"></a>
						<ul class="dropdown-menu">
							<li><a href="lend_equip.php">我要預借器材</a></li>
							<li><a href="return_equip.php">我要還器材</a></li>
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
			<form method="post" action = "return_equip_finish.php">
				<div class="form-group">
					<label for="equip">選擇器材:</label>
					<select name="lend_equip_ID">
					<?php
						session_start();
						include("mysqli_connect.inc.php");
						$user_ID = $_SESSION['user_ID'];//使用者
						$lend_equip_ID = $_GET['lend_equip_ID'];
						$sql3 = "SELECT * FROM lend_equip WHERE user_ID = '$user_ID'"; //使用者所有借據
						$stmt = $db->query($sql3);
						$result3=mysqli_fetch_object($stmt);

						if($_SESSION['user_number'] != null)
							{
								$sql = "SELECT * FROM equipment,lend_equip WHERE equipment.equip_ID = lend_equip.equip_ID && lend_equip.user_ID = '$user_ID'";
								//$sql = "SELECT equipment.equip_name,lend_equip.equip_ID,lend_equip.lend_equip_quan,lend_equip.lend_equip_ID FROM equipment, lend_equip WHERE lend_equip.equip_ID = equipment.equip_ID && user_ID = '$user_ID'";
								if($stmt = $db->query($sql))
								{
									while($result=mysqli_fetch_object($stmt))
									{
											echo "<option value=".$result->lend_equip_ID.">".$result->equip_name."歸還".$result->lend_equip_quan."個</option>";
																
									}

								}
							}	
							else
							{
								echo '你還沒登入';
								echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
							}
						
					?>
					</select><br>
				</div>
				<button type="submit" class="btn btn-default">確認</button>
			</form>
		</div>
	</body>
</html>