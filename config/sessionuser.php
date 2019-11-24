<?php
	ob_start();
	if($_SESSION['user_role'] == 'user')
	{
	    session_destroy();
	    header("location: /aayopayo/user/userdashboard.php");
	}
?>