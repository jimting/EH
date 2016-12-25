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
	  <p>以下是器材各項資料與狀態: </p>            
	  <table class="table table-hover">
		<thead>
			<tr>			
				<th>器材編號</th>
				<th>器材名稱</th>
				<th>剩餘數量</th>
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
					$sql = "SELECT * FROM equipment";
					if($stmt = $db->query($sql))
					{
						while($result=mysqli_fetch_object($stmt))
						{
								 echo "<tr><td>".$result->equip_ID."</td><td>".$result->equip_name."</td><td>".$result->equip_quantity."</td></tr>";
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