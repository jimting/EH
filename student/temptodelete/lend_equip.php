<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
	</head>
	<body>		  
		<form method="post" action = "lend_equip_finish.php">
		<div class="form-group">
		<label for="equip">選擇器材:</label>
		<select name="equip_ID">
	  
		<?php
			include("mysqli_connect.inc.php");
			$sql = "SELECT * FROM equipment WHERE equip_ID = $equip_ID";
			$stmt = $db->query($sql1);
			$result1=mysqli_fetch_object($stmt);
			$temp = 0;
			if($_SESSION['user_number'] != null)
			{
				$sql = "SELECT * FROM equipment WHERE equip_quantity > 0";//所有可借器材及數量
				if($stmt = $db->query($sql))
				{
					while($result=mysqli_fetch_object($stmt))
					{	
							echo "<option value=".$result->equip_ID.">".$result->equip_name."剩下".$result->equip_quantity."個</option>";
							if($result->equip_quantity > $temp)//計算最大輸入限制
								$temp = $result->equip_quantity;
					}
				echo '</select><br>
				<input type="number" class="form-control" name="howmany" placeholder="要借幾個(請勿超出剩下數量)" max = "'.$temp.'" min = "0" />
				<label for="equip">欲借日期:</label>
				<input type="date" class="form-control" name="startdays" placeholder="輸入日期" >
				<label for="equip">欲借天數:</label>
			  <input type="text" class="form-control" name="days" placeholder="輸入天數">
			</div>
			<button type="submit" class="btn btn-default">確認</button>
			</form>
			</div>';
				}
			}	
			else
			{
				echo '你還沒登入';
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
			}
			
		?>
	</body>
</html>