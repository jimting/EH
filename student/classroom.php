<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)-教室使用列表</title>
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
		<p>以下是教室今日使用狀態：</p>            
		<table class="table table-hover">
			<thead>
				<tr>			
					<th>教室編號</th>
					<th>教室名稱</th>
					<th>09:00~11:00</th>
					<th>11:00~13:00</th>
					<th>13:00~15:00</th>
					<th>15:00~17:00</th>
					<th> </th>
				</tr>
			</thead>
			<tbody>
			
				<?php
					session_start();
					include("mysqli_connect.inc.php");

					if($_SESSION['user_number'] != null)
					{
						$today = date ("Y-m-d" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
						echo $today;
						$sql = "SELECT * FROM classroom";
						if($stmt = $db->query($sql))
						{
							while($result=mysqli_fetch_object($stmt))
							{
									echo "<tr><td>".$result->room_ID."</td><td>".$result->room_name."</td>";
									$room_ID = $result->room_ID;
									for($temp = 0;$temp < 4;$temp++)
									{
										$sql2 = "SELECT * FROM user WHERE user_ID = (SELECT user_ID FROM lend_room WHERE room_ID = '$room_ID' AND lend_date = '$today' AND lend_time = '$temp')";
										if(mysqli_query($db, $sql2) != null)
										{
											if($stmt2 = $db->query($sql2))
											{
												if($result2 = mysqli_fetch_object($stmt2))
												{
													echo "<td><strong>".$result2->user_department."</strong><br>借用者學號：".$result2->user_number."</td>";
												}
												else
												{
													echo "<td>未借出</td>";
												}
											}
											else
											{
												echo "<td>未借出</td>";
											}
										}
										else
										{
											echo "<td>未借出</td>";
										}
									}
									echo "<td><a href='lend_room_checkdate.php?room_ID=".$result->room_ID."' class='btn btn-lg btn-default'>我想預借</a></td>";
									echo "</tr>";
										 
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