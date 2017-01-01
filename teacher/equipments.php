<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)-器材使用列表</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
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
			<p>以下是器材各項資料與狀態: </p>            
			<table class="table table-hover">
				<thead>
					<tr>			
						<th>器材編號</th>
						<th>器材名稱</th>
						<th>剩餘數量</th>
						<th><a href="new_equip.html" class="btn btn-lg btn-default">新增器材</a></th>
					</tr>
				</thead>
				<tbody>
				
					<?php
					include("mysqli_connect.inc.php");

					//此判斷為判定觀看此頁有沒有權限
					//說不定是路人或不相關的使用者
					//因此要給予排除
					if($_SESSION['user_number'] != null)
					{
							//將資料庫裡的所有會員資料顯示在畫面上
							$sql = "SELECT * FROM equipment";
							if($stmt = $db->query($sql))
							{
								while($result=mysqli_fetch_object($stmt))
								{
										 echo "<tr><td>".$result->equip_ID."</td><td>".$result->equip_name."</td><td>".$result->equip_quantity."</td><td><a href='delete_equip_check.php?id=".$result->equip_ID."' class='btn btn-lg btn-default'>刪除器材</a></td></tr>";
								}
							}
					}
					else
					{
							echo '您無權限觀看此頁面!';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
					}
					?>
				  
				</tbody>
			</table>
		</div>
	</body>
</html>