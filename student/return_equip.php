<?php session_start(); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</head>
	<body>
		<form method="post" action = "return_equip_finish.php">
		<div class="form-group">
			<label for="equip">選擇器材:</label>
			<select name="lend_equip_ID">
			<?php
			include("mysqli_connect.inc.php");
			$user_ID = $_SESSION['user_ID'];//使用者

			$sql3 = "SELECT * FROM lend_equip WHERE user_ID = '$user_ID'"; //使用者所有借據
			$stmt = $db->query($sql3);
			$result3=mysqli_fetch_object($stmt);

			if($_SESSION['user_number'] != null)
				{
					$sql = "SELECT * FROM equipment,lend_equip WHERE equipment.equip_ID = lend_equip.equip_ID && lend_equip.user_ID = '$user_ID'";
					//$sql = "SELECT equipment.equip_name,lend_equip.equip_ID,lend_equip.lend_equip_quan,lend_equip.lend_equip_ID FROM equipment, lend_equip WHERE lend_equip.equip_ID = equipment.equip_ID && user_ID = '$user_ID'";
					if($stmt = $db->query($sql))
					{
						while($result=mysqli_fetch_object($stmt))
						{
								echo "<option value=".$result->lend_equip_ID.">".$result->equip_name."歸還".$result->lend_equip_quan."個</option>";
													
						}

					}
				echo '</select><br>
				</div>
				<button type="submit" class="btn btn-default">確認</button>
				</form>
				</div>';
				}	
				else
				{
					echo '你還沒登入';
					echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
				}
				
			?>
	</body>
</html>