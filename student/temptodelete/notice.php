﻿<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!DOCTYPE html>
<html lang="en">
<head>
  <title>課指組器管屋(´・ω・`)-違規提醒</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            <li><a href="equipments.html">器材使用列表</a></li>
			<li><a href="classroom.html">教室使用列表</a></li>
          </ul>
        </li>
        <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">借還器材<span class="caret"></a>
          <ul class="dropdown-menu">
            <li><a href="lend.php">我要預借器材</a></li>
			<li><a href="return.html">我要還器材</a></li>
          </ul>
		</li>
		<li class="active">
			<a href='notice.html'>違規提醒專區</a>
		</li>
      </ul>
	  	<div class="design">
				<a href="http://www.stu.ntou.edu.tw/sc/" target="_blank"><p>國立臺灣海洋大學學生活動中心/課外活動指導組 器材借用網</p></a>
				<a target="_blank" href="https://www.facebook.com/IMJimmyLin"><p>Web Design by JT</p></a>
		</div>
    </div>
</nav>
<div class="container">
  <p>以下是出借天數超過七天的器材資料: </p>            
   	<table class="table table-hover">
    <thead>"


    </thead>
    <tbody>
					<tr>
  <?php
  include("mysqli_connect.inc.php");
  $today = date ("Y-m-d" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
  //SELECT *, datediff('2016-12-29',lend_equip.lend_date) as expireDays  FROM lend_equip  join equipment  group by lend_equip_ID having expireDays>$17
	$query = 'SELECT * FROM lend_equip join equipment group by lend_equip_ID';
  if($stmt = $db->query($query))
		{
			echo "<table border = '2'>
					<tr>
					<th>器材編號</th>
					<th>器材名稱</th>
					<th>出借日期</th>
					<th>欲借天數</th>
					<th>已借天數</th>
					<th>借出者學號</th>
					</tr>";
			while($result=mysqli_fetch_object($stmt))
			{	
				$days = (strtotime($today) - strtotime($result->lend_date))/ 86400;
				if($days > $result->lend_days)
						echo "<tr>";
						echo "<td>".$result->equip_ID."</td>";
						echo "<td>".$result->equip_name."</td>";
						echo "<td>".$result->lend_date."</td>";
						echo "<td>".$result->lend_days."</td>";
						echo "<td>".$days."</td>";
						echo "<td>".$result->user_ID."</td>";
						echo "</tr>";				
			}
		}
  
  
  ?>
 </tbody>
  </table>
</div>
</body>
</html>