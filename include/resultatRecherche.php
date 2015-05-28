<?php
if(isset($_POST["bp_rechercher"]) && !empty($_POST['villeDepart']) && !empty($_POST['villeDestination'])){
    
    $reqChercheD="SELECT * FROM Villes WHERE nomV='".$_POST['villeDepart']."';";
    $resChercheD=pg_query($conn, $reqChercheD);
    if (($villeD=pg_query($resChercheD)) != NULL)
        $idVilleD=$villeD[0];
    else
        $idVilleD=-1;
    
    
    $reqChercheA="SELECT * FROM Villes WHERE nomV='".$_POST['villeDestination']."';";
    $resChercheA=pg_query($conn, $reqChercheA);
    if (($villeA=pg_query($resChercheA)) != NULL)
        $idVilleA=$villeA[0];
    else
        $idVilleA=-1;
        


        
	// $reqVilleD="SELECT idVille FROM Villes WHERE nomV='".$_POST['villeDepart']."';";
	// $reqVilleA="SELECT idVille FROM Villes WHERE nomV='".$_POST['villeDestination']."';";
	// $reqVilleD=pg_query($conn, $reqVilleD) or die('Erreur select : '.pg_last_error($conn));
	// $reqVilleA=pg_query($conn, $reqVilleA) or die('Erreur select : '.pg_last_error($conn));
	// $idVilleD=pg_query($reqVilleD);
	// $idVilleD=$idVilleD[0];
	// $idVilleA=pg_query($reqVilleA);
	// $idVilleA=$idVilleA[0];

	// echo $_POST['date'];
    if (!empty($_POST['date']))
    {
				//On transforme la date en timestamp
                date_default_timezone_set('Europe/Paris');
                $exp_date = str_replace('/', '-', $_POST['date']);
				$date = strtotime($exp_date);

	$req="SELECT * FROM Trajets WHERE idVilleDepart=".$idVilleD." 
			AND idVilleDestination=".$idVilleA." 
			AND dateT BETWEEN ".($date)." AND ".($date+86400).";";
    }
    else
    {
	$req="SELECT * FROM Trajets WHERE idVilleDepart=".$idVilleD." 
			AND idVilleDestination=".$idVilleA.";";
    }

	$req=pg_query($conn, $req) or die('Erreur select : '.pg_last_error($conn));

?>
<h1> Resultat de la recherche : </h1>
 <div class="row marketing">
        <div class="col-lg-6">
<?php 

	while ($res = pg_fetch_array($req)){ 
		/*On va cherchr les informations relatifs au conducteur */
		$reqConducteur="SELECT * from CompteUtilisateur WHERE idU ='".$res['idConducteur'] . "'";
		$reqConducteur=pg_query($conn, $reqConducteur);
		$conducteur=pg_fetch_array($reqConducteur);
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


                
} else {
	
	
?>

    <div class="col-lg-12 alert alert-danger">Formulaire de recherche incomplet</div>
    <?php
    }
    ?>
	</div>
</div>