<?php session_start(); 
$user_ID = $_SESSION['user_ID'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action='return_classroom_action.php' method ='post'>
    <div class="form-group">
		<label for="classroom">選擇教室:</label>
		<select name="classroom">
　			<?php
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