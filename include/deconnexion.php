<?php
	session_destroy();
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php?p=';
	header("Location: http://$host$uri/$extra");
	exit;
?>