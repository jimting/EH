<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)-刪除教室</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="toastr.css" type="text/css" media="screen" />
		<script src="./toastr.js"></script>
		
		<?php
			session_start();
			include("mysqli_connect.inc.php");
			$room_ID = $_GET['room_ID'];
		?>
		<script>
			var room_ID = <?php echo $room_ID; ?>;
			toastr.options = {
				positionClass: 'toast-bottom-right',
			}
			$(document).ready(function()
			{
				$("#deletebutton").click(function()
				{
					$.post("delete_classroom_finish.php",
					{
					  room_ID: room_ID
					},
					function(result)
					{
						toastr.success('<strong>刪除教室成功啦！</strong><br>同時將有此教室的借據全數刪除<br>可以到教室總表確認<br>轉跳到教室總表！');
						setTimeout("location.href='classroom.php'",2000);
					});
				});
			});
		</script>
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
		<div class="container">
			<div class="form-group">
				<?php
				include "mysqli_connect.inc.php";
				$sql = "SELECT * FROM classroom WHERE room_ID = '$room_ID'";
				if($stmt = $db->query($sql))
				{
					while($result = mysqli_fetch_object($stmt))
					{
						echo "<h1>目前要刪除教室：<strong>".$result->room_name."</strong></h1>";
					}
				}
				?>
				<a id='deletebutton' class='btn btn-lg btn-default'>確定刪除</a>
			</div>
		</div>
	</body>
</html>