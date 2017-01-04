<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)-編輯器材</title>
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
					<li><a href="users.php">管理學生</a></li>
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
				$("#updatebutton").click(function()
				{
					$.post("update_equip_finish.php",
					{
					  equip_name:		$('#equip_name').val(),
					  equip_total:		$('#equip_total').val(),
					  equip_quantity:	$('#equip_quantity').val()
					},
					function(result){
						toastr.success('<strong>修改成功啦！</strong><br>可以到器材清單確認<br>轉跳到器材清單！');
						setTimeout("location.href='equipments.php'",2000);
					});
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
								
								echo	"<h1>編輯器材</h1>";
								echo '<form name="form" method="post" action="update_user_finish.php">';
								echo '器材編號：<input type="text" class="form-control" id="equip_ID" value="'.$result->equip_ID.'(此項目無法修改)" disabled /> <br>';
								echo '器材名稱：<input type="text" class="form-control" id="equip_name" value="'.$result->equip_name.'" /> <br>';
								echo '器材總數：<input type="text" class="form-control" id="equip_total" value="'.$result->equip_total.'" /> <br>';
								echo '器材剩餘數量：<input type="text" class="form-control" id="equip_quantity" value="'.$result->equip_quantity.'" /> <br>';			

								echo '<a id="updatebutton" class="btn btn-primary">確認修改</a>';
								
								echo '<h1>目前有預借此器材之名單</h1>';
								$sql2 = "SELECT * FROM lend_equip AS A,user AS B WHERE A.equip_ID = '$equip_ID' AND A.user_ID = B.user_ID";
								echo '<table class="table">
										<thead>
											<tr>
												<th>社團</th>
												<th>姓名</th>
												<th>借出日期</th>
												<th>借出數量</th>
												<th>預借天數</th>
												<th>已借天數</th>
											</tr>
										</thead>
										<tbody>';
								if($stmt2 = $db->query($sql2))
								{
									while($result2 = mysqli_fetch_object($stmt2))
									{
										$today = date ("Y-m-d" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
										$days = (strtotime($today) - strtotime($result2->lend_date))/ 86400;
										echo "<tr><td>".$result2->user_department."</td><td>".$result2->user_nickname."</td><td>".$result2->lend_date."</td><td>".$result2->lend_equip_quan."</td><td>".$result2->lend_days."</td><td>";
										if($days >= 0)
										{
											echo $days."</td></tr>";
										}
										else
										{
											echo "尚未借出</td></tr>";
										}
									}
								}
								echo "</tbody>";
							}
						}	
					else
					{
						echo '你還沒登入';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
					}
					?>
			</div>
		</div>
	</body>
</html>