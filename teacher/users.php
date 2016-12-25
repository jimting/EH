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
	  <p>以下是學生各項資料與狀態: </p>            
	  <table class="table table-hover">
		<thead>
			<tr>
				<th>哪個社團</th>
				<th>暱稱</th>
				<th>學號</th>
				<th>密碼</th>
				<th>Email</th>
				<th>連絡電話</th>
				<th>等級</th>
				<th>帳號創建日期</th>
				<th>管理學生</th>
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
					$sql = "SELECT * FROM user";
					if($stmt = $db->query($sql))
					{
						while($result=mysqli_fetch_object($stmt))
						{
								 echo "<tr><td>".$result->user_department."</td><td>".$result->user_nickname."</td><td>".$result->user_number."</td><td>".$result->user_pw."</td><td>".$result->user_email."</td><td>".$result->user_phone."</td><td>".$result->user_level."</td><td>".$result->user_date."</td><td><a href='delete_user_check.php?id=".$result->user_ID."' class='btn btn-lg btn-default'>刪除學生</a><a href='update_user.php?id=".$result->user_ID."' class='btn btn-lg btn-default'>編輯學生</a></td></tr>";
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
	</body>
</html>