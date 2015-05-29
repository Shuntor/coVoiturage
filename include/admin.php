<?php
/* Nom : admin.php
 * Description : Page ou l'administrateur pourra supprimer des utilisateurs et des trajets
 * Pages appelées : -   
 */

// On commence par vérifier que l'utilisateur est bien l'administrateur (dans le cas présent son identifiant est 'a')
if ($_SESSION['idU']=='a') { 

	// Si le bouton supprimé d'un utilisateur utilisé
	if (isset($_POST['supprimer'])) {
		//Suppression de l'utilisateur avec suppression des clés étrangères en cascade
		$suppression="DELETE FROM CompteUtilisateur  WHERE idU='".$_POST['idU']."';";
		$suppression=mysqli_query($conn, $suppression) or die('Erreur delete : '.mysqli_error($conn));
	}

	// Si le bouton d'un trajet a été utilisé
	if (isset($_POST['supprimerT'])) {	
		// Suppresion du trajet dans la table Postuler
		$suppressionP="DELETE FROM Postuler  WHERE idT='".$_POST['idT']."';";
		$suppressionP=mysqli_query($conn, $suppressionP) or die('Erreur delete : '.mysqli_error($conn));

		// Suppresion du trajet dans la table Etapes
		$suppressionE="DELETE FROM Etapes  WHERE idT='".$_POST['idT']."';";
		$suppressionE=mysqli_query($conn, $suppressionE) or die('Erreur delete : '.mysqli_error($conn));

		// Suppresion du trajet dans la table Avis
		$suppressionA="DELETE FROM Avis  WHERE idT='".$_POST['idT']."';";
		$suppressionA=mysqli_query($conn, $suppressionA) or die('Erreur delete : '.mysqli_error($conn));

		// Et enfin la suppresion du trajet dans la table Trajets
		$suppressionT="DELETE FROM Trajets  WHERE idT='".$_POST['idT']."';";
		$suppressionT=mysqli_query($conn, $suppressionT) or die('Erreur delete : '.mysqli_error($conn));

	}

	?>

	 <div class="row marketing">
	      <h2><center>Supprimer un utilisateur :</center></h2>
	       <div class="col-lg-12" >
	 	<form method="post" action="index.php?p=admin" onSubmit="return verif(this)">
	 <?php
	 
	    /* On récupère les utilisateurs inscrits au site */
	    $reqUtilisateur="SELECT * FROM CompteUtilisateur  where idU!='".$_SESSION['idU']."'";
		$reqUtilisateur=mysqli_query($conn, $reqUtilisateur) or die('Erreur select : '.mysqli_error($conn));

			while ($utilisateur = mysqli_fetch_array($reqUtilisateur)){
	            ?>
						
	    		<div class="form-group annonce mesutilisateurs col-lg-5 " style="margin-left:50px;margin-right:50;">
	          <h4><?php echo $utilisateur['prenomU']." ".$utilisateur['nomU']; ?></h4>
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
	 
	    /* On récupère les trajets */
	    $reqSelecTrajet="SELECT DISTINCT t.idT, t.dateT, t.heureD, t.heureA, t.idVilleDestination, t.idVilleDepart, t.idConducteur, t.idVoiture, c.nomU, v.marque 
	    				FROM Trajets t, Postuler p, CompteUtilisateur c, Voitures v  
	    				WHERE t.idT=p.idT AND t.idConducteur=c.idU AND v.idV=t.idVoiture 
	    				ORDER by t.idT;";
		$reqSelecTrajet=mysqli_query($conn, $reqSelecTrajet) or die('Erreur select : '.mysqli_error($conn));




			while ($trajet = mysqli_fetch_array($reqSelecTrajet)){ //Tant que des trajets peuent être récupéré
					//Requête que recherche le nom de la ville
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
}else{ //Cas où l'utilisateur n'est pas admin
	echo "Vous n'êtes pas administrateur !";

}
?>