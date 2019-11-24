<?php
	ob_start();
	if(!$_SESSION['user_role'] == 'admin')
	{
	    header('Location:/aayopayo/login.php');
	}
?>