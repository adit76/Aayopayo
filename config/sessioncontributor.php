<?php
	ob_start();
	if($_SESSION['user_role'] == 'contributor')
	{
	    session_destroy();
	    header("location: /aayopayo/contributor/contributordashboard.php");
	}
?>