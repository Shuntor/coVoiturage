<?php

require_once('header.php');

$con = mysqli_connect($domain,$user,$pass,$db);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
mysqli_query($con,"SELECT * FROM CompteUtilisateur");

mysqli_close($con);

?>
