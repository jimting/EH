﻿<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>課指組器管屋(´・ω・`)-學生總表</title>
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
		<li class="active"><a href="users.php">學生總表</a></li>
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
		<li>
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
  <p>以下是學生各項資料與狀態: </p>            
  <table class="table table-hover">
    <thead>
		<tr>
			<th>哪個社團</th>
			<th>暱稱</th>
			<th>Email</th>
			<th>連絡電話</th>
			<th>等級</th>
			<th>帳號創建日期</th>
		</tr>
    </thead>
    <tbody>
	
<?php
include("mysqli_connect.inc.php");
echo '<a href="logout.php">登出</a>  <br><br>';

//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['user_number'] != null)
{
        //將資料庫裡的所有會員資料顯示在畫面上
		$sql = "SELECT * FROM user";
		if($stmt = $db->query($sql))
		{
			while($result=mysqli_fetch_object($stmt))
			{
					 echo "<tr><td>".$result->user_department."</td><td>".$result->user_nickname."</td><td>".$result->user_email."</td><td>".$result->user_phone."</td><td>".$result->user_department."</td><td>".$result->user_level."</td><td>".$result->user_date."</td></tr>";
			}
		}
		echo "</tbody></table></div></body></html>";
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