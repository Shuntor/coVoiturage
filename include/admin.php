<?php
if ($_SESSION['idU']='a') {

	if (isset($_POST['supprimer'])) {	
		$suppression="DELETE FROM CompteUtilisateur  WHERE idU='".$_POST['idU']."';";
		$suppression=mysqli_query($conn, $suppression) or die('Erreur delete : '.mysqli_error($conn));
	}

	if (isset($_POST['supprimerT'])) {	
		$suppressionP="DELETE FROM Postuler  WHERE idT='".$_POST['idT']."';";
		$suppressionP=mysqli_query($conn, $suppressionP) or die('Erreur delete : '.mysqli_error($conn));

		$suppressionE="DELETE FROM Etapes  WHERE idT='".$_POST['idT']."';";
		$suppressionE=mysqli_query($conn, $suppressionE) or die('Erreur delete : '.mysqli_error($conn));

		$suppressionA="DELETE FROM Avis  WHERE idT='".$_POST['idT']."';";
		$suppressionA=mysqli_query($conn, $suppressionA) or die('Erreur delete : '.mysqli_error($conn));

		$suppressionT="DELETE FROM Trajets  WHERE idT='".$_POST['idT']."';";
		$suppressionT=mysqli_query($conn, $suppressionT) or die('Erreur delete : '.mysqli_error($conn));

	}

	?>

	 <div class="row marketing">
	      <h2><center>Supprimer un utilisateur :</center></h2>
	       <div class="col-lg-12" >
	 	<form method="post" action="index.php?p=admin" onSubmit="return verif(this)">
	 <?php
	 
	    /* On récupère les derniers utilisateurs de 1 à 10 */
	    $reqUtilisateur="SELECT * FROM CompteUtilisateur  where idU!='".$_SESSION['idU']."'";
		$reqUtilisateur=mysqli_query($conn, $reqUtilisateur) or die('Erreur select : '.mysqli_error($conn));

			while ($utilisateur = mysqli_fetch_array($reqUtilisateur)){
	            ?>
						
	    		<div class="form-group annonce mesutilisateurs col-lg-5 " style="margin-left:50px;margin-right:50;">
	          <h4><?php echo $utilisateur['prenomU']." > ".$utilisateur['nomU']; ?></h4>
	          <ul >
	            <li class="list-unstyled">ID : <?php echo $utilisateur['idU']; ?></li>
	            <li class="list-unstyled">Prenom: <?php echo $utilisateur['prenomU']; ?></li>
	            <li class="list-unstyled">Nom : <?php echo $utilisateur['nomU']; ?></li>
	            <li class="list-unstyled">Age : <?php echo $utilisateur['age']; ?></li>
	            <li class="list-unstyled">Genre : <?php echo $utilisateur['genre'] ?> </li>
	            <li class="list-unstyled">Mail : <?php echo $utilisateur['mail'] ?></li>
	            <li class="list-unstyled">Telephone : <?php echo $utilisateur['telephone'] ?></li>
	            <li class="list-unstyled">Pays : <?php echo $utilisateur['pays'] ?></li>
	            <input type="hidden"  name="idU"  value="<?php echo $utilisateur['idU'] ?>">		
	          </ul>
	            <center><input class="btn btn-danger" type='submit' value='Supprimer' name='supprimer' /></center>
	          </div> 
			<?php
	        }
	    ?>
		</form>
	 </div>
	 </div>


	  <div class="row marketing">
	      <h2><center>Supprimer un trajet :</center></h2>
	       <div class="col-lg-12" >
	 	<form method="post" action="index.php?p=admin" onSubmit="return verif(this)">
	 <?php
	 
	    /* On récupère les derniers utilisateurs de 1 à 10 */
	    $reqSuprTrajet="SELECT t.idT, t.dateT, t.heureD, t.heureA, t.idVilleDestination, t.idVilleDepart, t.idConducteur, t.idVoiture, c.nomU, v.marque 
	    				FROM Trajets t, Postuler p, CompteUtilisateur c, Voitures v  
	    				WHERE t.idT=p.idT AND p.idU=c.idU AND v.idU=c.idU  ;";
		$reqSuprTrajet=mysqli_query($conn, $reqSuprTrajet) or die('Erreur select : '.mysqli_error($conn));




			while ($trajet = mysqli_fetch_array($reqSuprTrajet)){
					$reqVille="SELECT vD.nomV, vA.nomV FROM Villes vD, Villes vA WHERE vD.idVille=".$trajet['idVilleDepart']." AND vA.idVille=".$trajet['idVilleDestination'].";";
					$reqVille=mysqli_query($conn, $reqVille) or die('Erreur select : '.mysqli_error($conn));
					$ville=mysqli_fetch_row($reqVille);
	            ?>
						
	    		<div class="form-group annonce mesutilisateurs col-lg-5 " style="margin-left:50px;margin-right:50;">
	          <h4><?php echo $ville[0]." > ".$ville[1]; ?></h4>
	          <ul >
	            <li class="list-unstyled">ID : <?php echo $trajet['idT']; ?></li>
	            <li class="list-unstyled">Date trajet : <?php echo date('d/m/Y', $trajet['dateT']); ?></li>
	            <li class="list-unstyled">Heure debut : <?php echo $trajet['heureD']; ?></li>
	            <li class="list-unstyled">Heure arrivée : <?php echo $trajet['heureA']; ?></li>
	            <li class="list-unstyled">Ville depart : <?php echo $ville[0]; ?> </li>
	            <li class="list-unstyled">Ville destination : <?php echo $ville[1]; ?></li>
	            <li class="list-unstyled">Conducteur : <?php echo $trajet['nomU']; ?></li>
	            <li class="list-unstyled">Voiture : <?php echo $trajet['marque']; ?></li>
	            <input type="hidden"  name="idT"  value="<?php echo $trajet['idT'] ?>">		
	          </ul>
	            <center><input class="btn btn-danger" type='submit' value='Supprimer' name='supprimerT' /></center>
	          </div> 
			<?php
	        }
	    ?>
		</form>
	 </div>
	 </div>
<?php
}else{
	echo "Vous n'êtes pas administrateur !";

}
?>