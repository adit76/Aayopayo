<?php 
  ob_start();
  session_start(); 
  //require('/khel/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/aayopayo/config/db.php";
  include $path;

  
  if(isset($_SESSION['user_id'])){
	  if($_SESSION['user_role'] != 'admin'){
		  session_destroy();
		  header('Location:/aayopayo/login.php');
	  }
	}else{
		header('Location:/aayopayo/login.php');
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin dashboard</title>
  <!-- Bootstrap core CSS-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Custom fonts-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="/aayopayo/cpanel/admin/inc/style.css" rel="stylesheet">
  <script src="/aayopayo/cpanel/admin/inc/js.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
</head>


<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->