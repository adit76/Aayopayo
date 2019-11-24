<?php
	include ('config/db.php');
	session_start();
	date_default_timezone_set("Asia/Kathmandu");
		
	$select_query = "SELECT * FROM ads a WHERE a.ad_status = 'active' AND ad_type='video' AND a.ad_end_date > NOW() AND a.prize <= 100";
		
	$result = mysqli_query($conn, $select_query);
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	header('Content-Type: application/json');
	echo json_encode($items);
	
?>