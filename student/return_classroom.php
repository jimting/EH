<?php session_start(); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</head>
	<body>
		<form action='return_classroom_action.php' method ='post'>
			<div class="form-group">
				<label for="classroom">選擇教室:</label>
				<select name="classroom">
		　			<?php
						$user_ID = $_SESSION['user_ID'];
						include "mysqli_connect.inc.php";
						$query = "SELECT * FROM lend_room NATURAL JOIN classroom WHERE user_ID = '$user_ID'";			
						if($stmt = $db->query($query))
						{
							while($result=mysqli_fetch_object($stmt))
							{
								echo "<option value=".$result->room_ID.">".$result->room_name."</option>";
							}
						}
					?>
				</select><br>
			</div>
			<button type='submit' class='btn btn-default'>確認</button>
		</form>
	</body>
</html>