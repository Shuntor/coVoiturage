<?php
	session_destroy();
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php?p=';
	//header("Location: http://$host$uri/$extra");
    echo "<h2>Déconnecté avec succés !</h2>";
    echo "<a href='http://$host$uri/$extra'>Retour à l'accueil</a>";
    echo "<script>window.location.replace('http://$host$uri/$extra');</script>";
	exit;
?>