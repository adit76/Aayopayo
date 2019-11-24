<?php
	include ('config/db.php');
	session_start();
	date_default_timezone_set("Asia/Kathmandu");
		
	if(isset($_GET["tok"])){
		if($_GET["tok"] != ''){
			$update_query = "UPDATE messages mr SET mr.status = 1 WHERE mr.user_id = ".$_SESSION['user_id']." && mr.status = 0 LIMIT 5";
			# Note: User ID is the Auth User, kept as 1 here to test
				
			$result = mysqli_query($conn, $update_query);
			echo $update_query;
		}
	}
	
	header('Content-Type: application/json');
	echo json_encode('OK');
	
?>