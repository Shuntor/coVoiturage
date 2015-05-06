<?php

$con = mysqli_connect($server,$user,$pass,$db);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$query = "SELECT *
FROM CompteUtilisateur
WHERE idU = '" . mysqli_real_escape_string($_SESSION['idU']) . "';";

$result = mysqli_query($con,$query);

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$utilisateur = $row;

// modifier info perso
// modifier voiture
// afficher notes (moyenne)

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
}


mysqli_close($con);

?>
