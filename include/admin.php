<?php
if (isset($_POST['supprimer'])) {	
	$suppression="DELETE FROM CompteUtilisateur  WHERE idU='".$_POST['idU']."';";
	$suppression=mysqli_query($conn, $suppression) or die('Erreur delete : '.mysqli_error($conn));
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
            <li class="list-unstyled">Prenom: <?php echo $utilisateur['prenomU'] ?></li>
            <li class="list-unstyled">Nom : <?php echo $utilisateur['nomU'] ?></li>
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