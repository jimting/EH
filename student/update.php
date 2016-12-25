<?php session_start(); ?>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</head>
	<body>
		<?php
		include('mysqli_connect.inc.php');

		if($_SESSION['user_number'] != null)
		{
				//將$_SESSION['id']丟給$id
				//這樣在下SQL語法時才可以給搜尋的值
				$id = $_SESSION['user_number'];
				//若以下$id直接用$_SESSION['username']將無法使用
				$sql = "SELECT * FROM user where user_number = '$id'";
				$stmt = $db->query($sql);
				$result=mysqli_fetch_object($stmt);
			
				echo '<form name="form" method="post" action="update_finish.php">';
				echo '學號：<input type="text" name="id" value="'.$result->user_number.'" />(此項目無法修改) <br>';
				echo '密碼：<input type="password" name="pw" value="'.$result->user_pw.'" /> <br>';
				echo '再一次輸入密碼：<input type="password" name="pw2" value="'.$result->user_pw.'" /> <br>';
				echo '暱稱：<input type="text" name="nickname" value="'.$result->user_nickname.'" /> <br>';
				echo 'Email：<input type="text" name="email" value="'.$result->user_email.'" /> <br>';
				echo '所屬社團/工作單位：<input type="text" name="department" value="'.$result->user_department.'"/> <br>';
				echo '連絡電話：<input type="text" name="phone" value="'.$result->user_phone.'"/> <br>';
				echo '<input type="submit" name="button" value="確定修改" />';
				echo '</form>';
		}
		else
		{
				echo '您無權限觀看此頁面!';
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
		}
		?>
	</body>
</html>