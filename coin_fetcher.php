<?php
	include ('config/db.php');
	session_start();
	date_default_timezone_set("Asia/Kathmandu");
		
	$select_query = "SELECT credit_left FROM statics s WHERE s.user_id = ".$_SESSION['user_id']." ORDER BY statics_id DESC LIMIT 1";
		
	$result = mysqli_query($conn, $select_query);
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	header('Content-Type: application/json');
	echo json_encode($items);
	
?>