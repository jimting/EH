<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!DOCTYPE html>
<html lang="en">
<head>
  <title>課指組器管屋(´・ω・`)-預借器材</title>
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
	<form>
    <div class="form-group">
      <label for="equip">選擇器材:</label>
      <select name="equip">
	  
<?php
	include("mysqli_connect.inc.php");
	if($_SESSION['user_number'] != null)
	{
		$sql = "SELECT * FROM equipment WHERE equip_quantity > 0";
		if($stmt = $db->query($sql))
		{
			while($result=mysqli_fetch_object($stmt))
			{
					 echo "<option value=".$result->equip_ID.">".$result->equip_name."剩下".$result->equip_quantity."個</option>";
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
	<input type="number" class="form-control" id="howmany" placeholder="要借幾個(請勿超出剩下數量)"/>
	  <label for="equip">學生學號:</label>
      <input type="text" class="form-control" id="equip" placeholder="輸入學號">
	  <label for="equip">學生姓名:</label>
      <input type="text" class="form-control" id="equip" placeholder="輸入姓名">
    </div>
    <button type="submit" class="btn btn-default">確認</button>
  </form>
</div>
</body>
</html>