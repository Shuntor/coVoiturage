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
    if (!empty($_POST['date']))
    {
	$date=strtotime($_POST['date']);

	$req="SELECT * FROM Trajets WHERE idVilleDepart=".$idVilleD." 
			AND idVilleDestination=".$idVilleA." 
			AND dateT BETWEEN ".($date)." AND ".($date+86400).";";
    }
    else
    {
	$req="SELECT * FROM Trajets WHERE idVilleDepart=".$idVilleD." 
			AND idVilleDestination=".$idVilleA.";";
    }

	$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));

?>
<h1> Resultat de la recherche : </h1>
 <div class="row marketing">
        <div class="col-lg-6">
<?php 

	while ($res = mysqli_fetch_array($req)){ 
		/*On va cherchr les informations relatifs au conducteur */
		$reqConducteur="SELECT * from CompteUtilisateur WHERE idU ='".$res['idConducteur'] . "'";
		$reqConducteur=mysqli_query($conn, $reqConducteur);
		$conducteur=mysqli_fetch_array($reqConducteur, MYSQLI_ASSOC);
		?>
		<div class="form-group annonce">
          <h4><?php echo $_POST['villeDepart']." > ".$_POST['villeDestination']; ?></h4>
          <ul >
            <li class="list-unstyled">Conducteur : <?php echo $conducteur['nomU']." ".$conducteur['prenomU']  ?></li>
            <li class="list-unstyled">Point de Rendez-vous : <?php echo $_POST['villeDepart'] ?></li>
            <li class="list-unstyled">Point d'Arrivée : <?php echo $_POST['villeDestination'] ?></li>
            <li class="list-unstyled">Date : <?php echo date('d/m/Y', $res['dateT']); ?></li>
            <li class="list-unstyled">Heure de Départ : <?php echo $res['heureD'] ?> </li>
            <li class="list-unstyled">Heure d'Arrrivée prévue : <?php echo $res['heureA'] ?> 
          </ul>
            <a class="btn btn-lg btn-success bouton" href="?p=trajetDetails&amp;t=<?=$res['idT']?>" role="button">Voir Détails...</a></li>
          </div> 
		<?php
					// echo "Date : ".$res['dateT']."  Heure de depart : ".$res['heureD']."  Heure d'arrivée : ".$res['heureA'];
				}

}
	
	
?>
	</div>
</div>