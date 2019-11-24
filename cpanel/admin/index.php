<?php 
include ('inc/header.php');

 ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php include ('inc/navigation.php'); ?>
	<div class="content-wrapper">
		<div class="containter-fluid">
			<h2>Welcome to the dashboard Mr. <?php echo $_SESSION['username']; ?></h2>
			<a href="/aayopayo/logout.php">Log Out</a>	
		</div>	
<?php include('inc/footer.php'); ?>