<!DOCTYPE html>
<html lang="en">
	<head>
		<title>課指組器管屋(´・ω・`)-違規提醒</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="notice.css" type="text/css" media="screen" />
		<script src="notice.js"></script>
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
							<li><a href="return_room.php">我要還器教室</a></li>
						</ul>
					</li>
					<li class="active">
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
		<div id="abgne-block-20120327">
			<ul class="tabs">
				<li><span>器材違規</span></li>
				<li><span>教室違規</span></li>
			</ul>
			<div class="tab_container">
				<ul class="tab_content">
					<li>
						<p>以下是出借天數超過欲借天數的器材資料:(若為空白代表沒有人違規) </p>            
						<table class="table table-hover">
							<thead>
							  <tr>
								<th>器材編號</th>
								<th>器材名稱</th>
								<th>出借日期</th>
								<th>欲借天數</th>
								<th>已借天數</th>
								<th>借出者學號</th>
							  </tr>
							</thead>
							<tbody>
								<?php
									session_start();
									include("mysqli_connect.inc.php");
									$today = date ("Y-m-d" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
									//SELECT *, datediff('2016-12-29',lend_equip.lend_date) as expireDays  FROM lend_equip  join equipment  group by lend_equip_ID having expireDays>$17
									$query = 'SELECT * FROM lend_equip join equipment join user group by lend_equip_ID';
									if($stmt = $db->query($query))
									{
										while($result=mysqli_fetch_object($stmt))
										{	
											$days = (strtotime($today) - strtotime($result->lend_date))/ 86400;
											if($days > $result->lend_days)
											{
												echo "<tr>";
												echo "<td>".$result->equip_ID."</td>";
												echo "<td>".$result->equip_name."</td>";
												echo "<td>".$result->lend_date."</td>";
												echo "<td>".$result->lend_days."</td>";
												echo "<td>".$days."</td>";
												echo "<td>".$result->user_number."</td>";
												echo "</tr>";		
											}							
										}
									}
								?>
							</tbody>
						</table>
					</li>
					<li>
						<p>以下是出借天數超過三天的教室資料:(若為空白代表沒有人違規) </p>            
						<table class="table table-hover">
							<?php
								include "mysqli_connect.inc.php";
								$datetime = date ("Y-m-d" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
								$sql = "SELECT *,
										(CASE lend_time WHEN '0' THEN '9~11' WHEN '1' THEN '11~13' WHEN '2' THEN '13~15' WHEN '3' THEN '15~17' END)AS lend_time
										FROM lend_room,classroom,user
										WHERE lend_room.room_ID = classroom.room_ID AND lend_room.user_ID = user.user_ID";//時段編號轉成時段,user顯示學號
								if($stmt = $db->query($sql))
								{
									echo '
									<thead>
										<tr>
											<th>教室編號</th>
											<th>教室名稱</th>
											<th>借出狀況</th>
											<th>出借日期</th>
											<th>出借時段</th>
											<th>已借天數</th>
											<th>借出者學號</th>
										</tr>
									</thead>
									<tbody>';
									while($result=mysqli_fetch_object($stmt))
									{
										$days = (strtotime($datetime) - strtotime($result->lend_date))/86400;
										if($days > 3)
										{
											echo '
											<tr>
												<td>'.$result->room_ID.'</td>
												<td>'.$result->room_name.'</td>
												<td>已借出</td>
												<td>'.$result->lend_date.'</td>
												<td>'.$result->lend_time.'</td>
												<td>已借'.$days.'天</td>
												<td>'.$result->user_number.'</td>
											</tr>
											';
										}
									}
								}
							?>
						  
							</tbody>
						</table>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>