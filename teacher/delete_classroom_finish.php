<?php

include "mysqli_connect.inc.php";
$room_ID=$_POST["room_ID"];

$stmt = $db->prepare('Delete FROM classroom WHERE room_ID=?');
$stmt->bind_param('s',$room_ID);
$stmt->execute();

$sql = "SELECT * FROM lend_room WHERE room_ID = '$room_ID'";
if($stmt = $db->query($sql))
{
	while($result = mysqli_fetch_object($stmt))
	{
		$sql2 = "DELETE FROM lend_room WHERE lend_room_ID = '$result->lend_room_ID'";
		mysqli_query($db, $sql2);
	}
}
?>