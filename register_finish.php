<?php session_start(); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="login.css">
	</head>
	<body>
		<?php
		include("mysqli_connect.inc.php");

		$id = $_POST['id'];
		$pw = $_POST['pw'];
		$pw2 = $_POST['pw2'];
		$phone = $_POST['phone'];
		$nickname = $_POST['nickname'];
		$email = $_POST['email'];
		$department = $_POST['department'];

		//判斷帳號密碼是否為空值
		//確認密碼輸入的正確性
		if($id != null && $pw != null && $pw2 != null && $pw == $pw2)
		{
				//新增資料進資料庫語法
				$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
				$sql = "insert into user (user_number, user_pw,user_nickname,user_email,user_department,user_phone,user_date) values ('$id','$pw','$nickname','$email', '$department', '$phone', '$datetime')";
				if(mysqli_query($db,$sql))
				{
						echo '<div class="login"><h1>新增成功！<h1><br><h1>轉回登入頁！</h1></div>';
						echo '<meta http-equiv=REFRESH CONTENT=3;url=login.html>';
				}
				else
				{
						echo '<div class="login"><h1>新增失敗！<h1><br><h1>轉回登入頁！</h1></div>';
						echo '<meta http-equiv=REFRESH CONTENT=3;url=register.html>';
				}
		}
		else
		{
				echo '<div class="login"><h1>您無權限觀看此頁面！<h1><br><h1>轉回登入頁！</h1></div>';
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
		}
		?>
	</body>
</html>