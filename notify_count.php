<?php
	include ('config/db.php');
	session_start();
	date_default_timezone_set("Asia/Kathmandu");
		
	#IN THE DASHBOARD - INSERT INTO DATABASE FOR EVERY USER WITH status = 0 every time.....deal done...

	$search_query = "select * from messages mr WHERE mr.status = 0 && mr.user_id = " . $_SESSION['user_id'];
	# Note: User ID is the Auth User, kept as 1 here to test
		
	$result = mysqli_query($conn, $search_query);
	
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	header('Content-Type: application/json');
	echo json_encode($items);
	
?>