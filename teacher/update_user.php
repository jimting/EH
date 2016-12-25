<?php session_start(); ?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
	</head>
	<body>
		<?php
		include('mysqli_connect.inc.php');
		if($_SESSION['user_number'] != null)
		{
				//將$_SESSION['id']丟給$id
				//這樣在下SQL語法時才可以給搜尋的值
				$id = $_GET['id'];
				//若以下$id直接用$_SESSION['username']將無法使用
				$sql = "SELECT * FROM user where user_id = '$id'";
				$stmt = $db->query($sql);
				$result=mysqli_fetch_object($stmt);
			
				echo '<form name="form" method="post" action="update_finish.php">';
				echo '學號：<input type="text" name="id" value="'.$result->user_number.'" />(此項目無法修改) <br>';
				echo '密碼：<input type="text" name="pw" value="'.$result->user_pw.'" /> <br>';
				echo '再一次輸入密碼：<input type="text" name="pw2" value="'.$result->user_pw.'" /> <br>';
				echo '暱稱：<input type="text" name="nickname" value="'.$result->user_nickname.'" /> <br>';
				echo 'Email：<input type="text" name="email" value="'.$result->user_email.'" /> <br>';
				echo '所屬社團/工作單位：<input type="text" name="department" value="'.$result->user_department.'"/> <br>';
				echo '連絡電話：<input type="text" name="phone" value="'.$result->user_phone.'"/> <br>';
				echo '等級：<input type="text" name="phone" value="'.$result->user_level.'"/> <br>';
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