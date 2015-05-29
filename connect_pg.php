<?php
    /*
	$conn = mysqli_connect("localhost","root","" ,"covoiturage")
	or die ("Connexion impossible : " . mysqli_connect_error());
	mysqli_query($conn, "SET NAMES UTF8");
    */

    $conf = "host=localhost port=5432 dbname=covoiturage user=postgres password=root options='--client_encoding=UTF8'";
    $conn = pg_connect($conf);
    pg_query($conn, "SET NAMES 'UTF8'");

    
?>  

