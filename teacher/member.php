<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");
echo '<a href="logout.php">登出</a>  <br><br>';

//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['user_number'] != null)
{
	echo '<html>
			<head>
				<title>會員資料</title>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</head>
			<body>
				<div class="container">
					<h2>以下是User資料</h2>         
					<table class="table table-hover">
						<thead>
							<tr>
								<th>編號</th>
								<th>學號</th>
								<th>密碼</th>
								<th>暱稱</th>
								<th>Email</th>
								<th>連絡電話</th>
								<th>所屬單位</th>
								<th>等級</th>
								<th>帳號創建日期</th>
							</tr>
						</thead>
						<tbody>';
        echo '				<a href="register.html">新增</a>    ';
        echo '				<a href="update.php">修改</a>    ';
        echo '				<a href="delete.php">刪除</a>  <br><br>';
    
        //將資料庫裡的所有會員資料顯示在畫面上
		$sql = "SELECT * FROM user";
		if($stmt = $db->query($sql))
		{
			while($result=mysqli_fetch_object($stmt))
			{
					 echo "<tr><td>".$result->user_ID."</td><td>".$result->user_number."</td><td>".$result->user_pw."</td><td>".$result->user_nickname."</td><td>".$result->user_email."</td><td>".$result->user_phone."</td><td>".$result->user_department."</td><td>".$result->user_level."</td><td>".$result->user_date."</td></tr>";
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