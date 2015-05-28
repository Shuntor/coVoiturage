
<?php
    
    $req="SELECT 1 FROM Voitures WHERE idU='".$_SESSION['idU'] ."'";
    $res=mysqli_query($conn, $req) or die ('Erreur select check voiture'.mysqli_error($conn));
    if (mysqli_num_rows($res) < 1)
    {
        echo "<div class='col-lg-12 alert alert-danger'>Pas de voiture ! Ajoutez une voiture avant de continuer !<br/>
        <a href='?p=gestionProfil'>Aller à la gestion de mon profil...</a></div>";
    }
        
	if(isset($_POST["bp_valider"])&& !empty($_POST['villeDepart']) && !empty($_POST['villeDestination']))
			{

				//echo $_POST['dateTrajet']." - ".$_POST['lieuDepart']." - ".$_POST['hD']." - ".$_POST['lieuArrivee']." - ".$_POST['hA']." - ".$_POST['voiture'];
                $formValide=true;
                if (empty($_POST['voiture']))
                {
                    $formValide=false;
                    echo "<div class='col-lg-12 alert alert-danger'><strong>Pas de voiture ! Ajoutez une voiture avant de continuer !<br/>
                    <a href='?p=gestionProfil'>Aller à la gestion de mon profil...</a></strong></div>";
                }
                if (empty($_POST['dateTrajet']))
                {
                    $formValide=false;
                    echo "<div class='col-lg-12 alert alert-danger'>Date vide !</div>";
                }
                if (preg_match("/(2[0-3]|[01][0-9]):[0-5][0-9]/", $_POST['hA']) && preg_match("/(2[0-3]|[01][0-9]):[0-5][0-9]/", $_POST['hD']) && $formValide)
                {
                
				//On transforme la date en timestamp
                
                date_default_timezone_set('Europe/Paris');
                $exp_date = str_replace('/', '-', $_POST['dateTrajet']);
				$timestamp = strtotime($exp_date);
                
                    // On cherche ou insère la ville de départ
                    $reqChercheD="SELECT * FROM Villes WHERE nomV='".$_POST['villeDepart']."';";
                    $resChercheD=mysqli_query($conn, $reqChercheD);
                    if (($villeD=mysqli_fetch_row($resChercheD)) != NULL)
                        $idVilleD=$villeD[0];
                    else
                    {
                        $reqInsertD="INSERT INTO Villes (nomV) VALUES ('" .$_POST['villeDepart']. "');";
                        $resInsertD=mysqli_query($conn, $reqInsertD);
                        $reqChercheD="SELECT * FROM Villes WHERE nomV='".$_POST['villeDepart']."';";
                        $resChercheD=mysqli_query($conn, $reqChercheD);
                        $villeD=mysqli_fetch_row($resChercheD);
                        $idVilleD=$villeD[0];
                    }


                    // On cherche ou insère la ville d'arrivée
                    $reqChercheA="SELECT * FROM Villes WHERE nomV='".$_POST['villeDestination']."';";
                    $resChercheA=mysqli_query($conn, $reqChercheA);
                    if (($villeA=mysqli_fetch_row($resChercheA)) != NULL)
                        $idVilleA=$villeA[0];
                    else
                    {
                        $reqInsertA="INSERT INTO Villes (nomV) VALUES ('" .$_POST['villeDestination']. "');";
                        $resInsertA=mysqli_query($conn, $reqInsertA);
                        $reqChercheA="SELECT * FROM Villes WHERE nomV='".$_POST['villeDestination']."';";
                        $resChercheA=mysqli_query($conn, $reqChercheA);
                        $villeA=mysqli_fetch_row($resChercheA);
                        $idVilleA=$villeA[0];
                    }

				//requete permettant d insérer le trajet dans la base de donnée
				$requete="insert into Trajets(dateT, heureD, heureA, idVilleDepart, idVilleDestination, idConducteur, idVoiture) values('".$timestamp."','".$_POST['hD']."','".$_POST['hA']."','".$idVilleD."','".$idVilleA."','".$_SESSION['idU']."','".$_POST['voiture']."')";
				$resultat = mysqli_query($conn, $requete) OR die('Erreur insertion : '.mysqli_error($conn));

				?>

				<!-- Il faut décorer ça  -->
				<strong> Saisie enregistrée ! </strong><br><br />
				<a href="index.php?p="> Retourner à l'accueil </a>
				<?php } else {
                ?>
                
				<!-- Il faut décorer ça  --><br />
                <strong> Format de l'heure incorrect ! Merci d'utiliser heures:minutes ! <br />Comme 14:33 par exemple.<br/><br /> </strong>
				<a href="index.php?p=mesTrajets"> Retourner à mes Trajets </a>
                
                <?php } ?>
                
				
								
				<?php
			}else{
				$req="SELECT * FROM Voitures WHERE idU='" . $_SESSION['idU'] . "'";
				$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));
				/*$res=mysqli_fetch_array($req);*/
                
                
                
                
				
?>					

						<!-- création du formulaire de saisie -->

<div class="form-group annonce col-lg-12">
  <div class="page-header">
    <h1>Saisie d'un trajet : </h1>
    <p class="lead">Saisie des informations du trajet de <?php echo $_SESSION["prenomU"]." ".$_SESSION["nomU"]; ?> 	</p>
  </div> 
    <script src="http://maps.google.com/maps/api/js?libraries=places&region=fr&language=fr"></script>
	<form method="post" action="index.php?p=mesTrajets" onSubmit="return verif(this)">

		<center><table class=" tableauTrajet">
		<caption>Saisie des informations du trajet de <?php echo $_SESSION["prenomU"]." ".$_SESSION["nomU"]; ?> </caption>
		<tr><td>Quel jour souhaitez vous voyager ? <input type="text" id="datepicker" name="dateTrajet" placeholder="Ex: 15/10/2015"></td></tr>

		<tr><td>Lieu de départ :</td>
			<td>
			
                    <input id="ville" type="text" name="villeDepart" class="form-control" placeholder="Ex: Toulouse, Foix...">
                    
                    </td>
			<td>Heure : <input type="text" name="hD" placeholder="13:00"></td>
		</tr>
		
		<tr><td>Lieu d'arrivée :</td>
			<td>
                    <input id="ville2" type="text" name="villeDestination" class="form-control" placeholder="Ex: Bordeaux, Mérignac...">
                    
                    </td>
			<td>Heure : <input type="text" name="hA" placeholder="14:00"></td>
		</tr>
		<tr><td>Voiture : </td><td>
			<select class="form-control" name="voiture">
			<?php while ($resVoitures = mysqli_fetch_array($req)){ ?>
						  <option value=<?php echo $resVoitures['idV']; ?> ><?php echo $resVoitures['marque']." ".$resVoitures['couleur']." (".$resVoitures['nbPLace']." places)"; ?></option>
			<?php }?>
			</select></td>
		</tr>
		</table></center>
		
		<!--bloc contenant le bouton valider-->
		<div>
			<input type='submit' value='Valider' name='bp_valider' />
		</div>
	</form>
    <br />

<!-- Affichage des précédents trajets -->


  
      <h2><center>Mes 20 derniers trajets :</center></h2>
    <div class="col-lg-12" >
	    <?php
	    
	    /* On récupère les trajets de l'utilisateur courant */
	    $reqTrajets="select v1.nomV as villeDepart, v2.nomV as villeArrivee, t.dateT as date, t.heureD as heureDepart, t.heureA as heureArrivee, idT from Trajets t, Villes v1, Villes v2 where t.idConducteur = '" . $_SESSION['idU'] . "' and v1.idVille = t.idVilleDepart and v2.idVille = t.idVilleDestination ORDER BY t.dateT LIMIT 20";
		$resTrajets=mysqli_query($conn, $reqTrajets) or die('Erreur select : '.mysqli_error($conn));
		while ($trajet = mysqli_fetch_array($resTrajets)){ ?>
				
		<div class="form-group annonce mesTrajets col-lg-5 " style="margin-left:50px;margin-right:20;">
          <h4><?php echo $trajet['villeDepart']." > ".$trajet['villeArrivee']; ?></h4>
          <ul >
            <li class="list-unstyled">Point de Rendez-vous : <?php echo $trajet['villeDepart'] ?></li>
            <li class="list-unstyled">Point d'Arrivée : <?php echo $trajet['villeArrivee'] ?></li>
            <li class="list-unstyled">Date : <?php echo date('d/m/Y', $trajet['date']); ?></li>
            <li class="list-unstyled">Heure de Départ : <?php echo $trajet['heureDepart'] ?> </li>
            <li class="list-unstyled">Heure d'Arrrivée prévue : <?php echo $trajet['heureArrivee'] ?> </li>
          </ul>
          	<a class="btn btn-lg btn-success bouton" href="?p=trajetDetails&amp;t=<?=$trajet['idT']?>" role="button">Voir Détails...</a></li>
        </div>
</div>    	
		<?php
        }
		?>
		      
    </div>
    
   
    
	<?php
}?>