<form action='lend_classroom_action.php' method ='post'>
    <div class="form-group">
      <label for="classroom">選擇教室:</label>
		<select name="classroom">
			<?php
				include "mysqli_connect.inc.php";
				$query = "SELECT * FROM classroom where room_status = 0";
				if($stmt = $db->query($query))
				{
					while($result=mysqli_fetch_object($stmt))
					{
						echo "<option value=".$result->room_ID.">".$result->room_name."</option>";
					}
				}
			?>
	</div>
<input type='submit' class='btn btn-default' value='Submit'>
</form>