<?php
	session_start();
	session_destroy();

//The session is destroyed. and user is redirected to the login page.
	$_SESSION['message']='You are now logged out';
	header('Location: /aayopayo');

?>