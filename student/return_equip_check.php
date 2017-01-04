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
		<link rel="stylesheet" href="toastr.css" type="text/css" media="screen" />
		<script src="./toastr.js"></script>
		
		<?php
			session_start();
			include("mysqli_connect.inc.php");
			$user_ID = $_SESSION['user_ID'];//使用者
			$lend_equip_ID = $_GET['lend_equip_ID'];
		?>
		<script>
			var lend_equip_ID = <?php echo $lend_equip_ID; ?>;
			toastr.options = {
				positionClass: 'toast-bottom-right',
			}
			$(document).ready(function()
			{
				$("#returnbutton").click(function()
				{
					$.post("return_equip_finish.php",
					{
					  lend_equip_ID: lend_equip_ID
					},
					function(result)
					{
						toastr.success('<strong>歸還成功啦！</strong><br>可以到個人資訊確認<br>轉跳到個人資訊！');
						setTimeout("location.href='userinfo.php'",2000);
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
					<li class="active"><a href="index.html">回首頁</a></li>
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
		<div class="container">
			<div class="form-group">
				<?php
					$sql = "SELECT * FROM equipment AS A1, lend_equip AS A2 WHERE A1.equip_ID = A2.equip_ID AND A2.lend_equip_ID = '$lend_equip_ID'";
					if($stmt = $db->query($sql))
					{
						while($result=mysqli_fetch_object($stmt))
						{
							echo "<h1>歸還<strong>".$result->equip_name."</strong>，借了".$result->lend_equip_quan."個</h1>";
						}
					}
				?>
				<a id='returnbutton' class='btn btn-lg btn-default'>確定歸還</a>
			</div>
		</div>
	</body>
</html>