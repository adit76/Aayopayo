<?php
	include ('config/db.php');
	session_start();
	date_default_timezone_set("Asia/Kathmandu");
		
	$search_query = "select * from messages where user_id = ".$_SESSION['user_id']." ORDER BY status ASC LIMIT 0,5";
		
	$result = mysqli_query($conn, $search_query);
	
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	header('Content-Type: application/json');
	echo json_encode($items);
	
?>