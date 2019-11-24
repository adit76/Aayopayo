<?php 
session_start();
require('../config/db.php');
require('../config/sessioncontributor.php');

if(!isset($_SESSION['username'])){
    header('Location: /khel/login.php');
    die(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Khelyo Ki Jityo</title>
    <?php include ('inc/header.php'); ?>
</head>
<body>
<?php include ('inc/navigation.php'); ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
		<h2>Welcome to the dashboard Mr. <?php echo $_SESSION['username']; ?></h2>
		<a href="/khel/logout.php">Log Out</button>

			<?php include 'inc/footer.php'; ?>
</body>

</html>