<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)-預借器材</title>
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
		<?php
			session_start();
			include("mysqli_connect.inc.php");
			$equip_ID = $_GET['equip_ID'];
			$max = 0;
		?>
		<script>
			var equip_ID = <?php echo $equip_ID;?>;
			var max = 0;
			toastr.options = {
				positionClass: 'toast-bottom-right',
			}
			$(document).ready(function()
			{
				$("#ajaxbutton").click(function()
				{
					if($('#howmany').val() <= max && $('#days').val() <= 7)
					{
						$.post("lend_equip_finish.php",
						{
						  equip_ID:		equip_ID,
						  howmany:		$('#howmany').val(),
						  startdays:	$('#datepicker').val(),
						  days:			$('#days').val()
						},
						function(result){
							toastr.success('<strong>預借成功啦！</strong><br>可以到個人資訊確認<br>轉跳到器材清單！');
							setTimeout("location.href='equipments.php'",2000);
						});
					}
					else
					{
						toastr.warning('<strong>數量有誤！</strong><br>請再次確認預借數量與天數<br>不可超過指定數值！');
					}
				});
			});
			
		</script>
	</head>
	<body>
		<div class="container">
			<div class="form-group">
					<?php
						if($_SESSION['user_number'] != null)
						{
							$sql = "SELECT * FROM equipment WHERE equip_ID = '$equip_ID'";
						if($stmt = $db->query($sql))
						{
							$result=mysqli_fetch_object($stmt);
							echo "<h1>".$result->equip_name."剩下".$result->equip_quantity."個</h1>";
							$max = $result->equip_quantity; //剩下多少個
							echo '
							<input type="number" class="form-control" id="howmany" placeholder="要借幾個" max = "'.$max.'" min = "0" required="required"/>
							<label for="equip">欲借日期:</label>
							<input class="form-control" name="startdays" id="datepicker" placeholder="輸入日期" required="required">
							<label for="equip">欲借天數:</label>
							<input type="number" class="form-control" id="days" placeholder="輸入天數(最多借7天)" max = "7" required="required">';
						}
						echo "<script>max = ".$max.";</script>";
					}	
					else
					{
						echo '你還沒登入';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
					}
					?>
			</div>
			<button id="ajaxbutton" class="btn btn-default">確認</button>
		</div>
	</body>
</html>