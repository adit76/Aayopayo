<?php
	include ('config/db.php');
	session_start();
	date_default_timezone_set("Asia/Kathmandu");
		
	if(isset($_GET["tok"]) && isset($_GET["prize"])){
		if($_GET["tok"] != '' && $_GET["prize"] != '' && intval($_GET["prize"]) <= 100){
			$prize = $_GET["prize"];
			$update_query = "UPDATE statics s SET s.credit_left = s.credit_left+". $prize ." WHERE s.user_id =".$_SESSION['user_id'];
			# Note: User ID is the Auth User, kept as 1 here to test
			# Prize is max limited to 100
				
			$result = mysqli_query($conn, $update_query);
		}		
	}
	
	header('Content-Type: application/json');
	echo json_encode(array($_GET["prize"],$_GET["tok"]));
	
?>