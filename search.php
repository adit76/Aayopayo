<?php
	include ('config/db.php');
	session_start();
	date_default_timezone_set("Asia/Kathmandu");

	//Getting Query Product
	
	if(isset($_GET['query'])){
		$query = $_GET['query'];
		
		$search_query = "select * from products WHERE product_status='active' AND product_name LIKE '%{$query}%' OR product_category LIKE '%{$query}%' order by product_name";
		
		#$search_query = 'select * from products WHERE product_status="active"';
		
		$result = mysqli_query($conn, $search_query);
		
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

		header('Content-Type: application/json');
		echo json_encode($items);
	}
	
	
	if(isset($_GET['find'])){
		$query = $_GET['find'];
		
		if($query == 'all'){
			$search_query = "select * from products WHERE product_status='active' order by product_name";
		}else{
			$search_query = "select * from products WHERE product_status='active' AND product_category LIKE '%{$query}%' order by product_name";
		}
		
		$result = mysqli_query($conn, $search_query);
		
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

		header('Content-Type: application/json');
		echo json_encode($items);
	}
	
?>