<?php
	include ('../config/db.php');
	session_start();
	date_default_timezone_set("Asia/Kathmandu");
		
	if(isset($_GET['id'])){
		$select_query = "SELECT first_name, last_name, a.user_id FROM auction_details a INNER JOIN users u on a.user_id = u.user_id WHERE product_id = " . $_GET['id'] . " ORDER BY first_name";
			
		$result = mysqli_query($conn, $select_query);
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		header('Content-Type: application/json');
		echo json_encode($items);
	}else{
		header('Content-Type: application/json');
		echo json_encode(array('error'));
	}
	
?>