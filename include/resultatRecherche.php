<?php
if(isset($_POST["bp_rechercher"])){
	$reqVilleD="SELECT idVille FROM Villes WHERE nomV='".$_POST['villeDepart']."';";
	$reqVilleA="SELECT idVille FROM Villes WHERE nomV='".$_POST['villeDestination']."';";
	$reqVilleD=mysqli_query($conn, $reqVilleD) or die('Erreur select : '.mysqli_error($conn));
	$reqVilleA=mysqli_query($conn, $reqVilleA) or die('Erreur select : '.mysqli_error($conn));
	$idVilleD=mysqli_fetch_row($reqVilleD);
	$idVilleD=$idVilleD[0];
	$idVilleA=mysqli_fetch_row($reqVilleA);
	$idVilleA=$idVilleA[0];

	// echo $_POST['date'];
	$date=strtotime($_POST['date']);

	$req="SELECT * FROM Trajets WHERE idVilleDepart=".$idVilleD." 
			AND idVilleDestination=".$idVilleA." 
			AND dateT BETWEEN ".($date)." AND ".($date+86400).";";


	$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));

	while ($res = mysqli_fetch_array($req)){ 
					echo "Date : ".$res['dateT']."  Heure de depart : ".$res['heureD']."  Heure d'arrivée : ".$res['heureA'];
				}

}
	
	
?>