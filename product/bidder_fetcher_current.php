<?php
	include ('../config/db.php');
	session_start();
	date_default_timezone_set("Asia/Kathmandu");
		
	if(isset($_GET['id'])){
		$select_query = "SELECT a.user_id, a.bidprice FROM auction_details a WHERE product_id = " . $_GET['id'] . " AND user_id = " . $_SESSION['user_id'];
		$result = mysqli_query($conn, $select_query);
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		header('Content-Type: application/json');
		echo json_encode($items);
	}else{
		header('Content-Type: application/json');
		echo json_encode(array('error'));
	}
	
?>