<div class="annonce3 col-lg-12">
<?php
if(isset($_POST["bp_valider"])){
	$explode= explode("/", $_POST['trajet']);
	$idT=$explode[0];
	$idConducteur=$explode[1];
	$requete="INSERT INTO Avis(idDonneur, idReceveur, idT, texte, note) values('".$_SESSION['idU']."','".$idConducteur."',".$idT.",'".addslashes($_POST['texte'])."',".$_POST['note'].");";
	$resultat = pg_query($conn, $requete) OR die('Erreur insertion : '.pg_last_error($conn));
    
    // on met à jour la moyenne de l'utilisateur
    $req="SELECT AVG(note) FROM Avis WHERE idReceveur='".$idConducteur."'";
    $res=pg_query($conn, $req) OR die ('Erreur select moyenne avis :'.pg_last_error($conn));
    $note=pg_fetch_row($res);
    $req="UPDATE CompteUtilisateur set moyenne='" . $note[0] . "' where idU='".$idConducteur."'";
    $res=pg_query($conn, $req) OR die ('Erreur insert moyenne avis :'.pg_last_error($conn));
    
	?>

	<strong> Saisie enregistrée ! </strong><br>
	<a href="index.php?p="> Retourner à l'accueil </a>
	<?php
}else{

	$reqPostuler="SELECT * FROM Postuler p, Trajets t WHERE (p.idU='".$_SESSION['idU']."' AND p.idT=t.idT AND p.idT NOT IN (SELECT idT FROM Avis WHERE idDonneur ='".$_SESSION['idU']."' ));";
	$reqPostuler = pg_query($conn, $reqPostuler) OR die('Erreur select : '.pg_last_error($conn));

?> 
<div class="page-header">
    <h1>Saisie d'un avis :</h1>
	<form role="form" method="post" action="index.php?p=mesAvis" onSubmit="return verif(this)">
		
		<p><label for="trajet" class="col-lg-1">Trajet :</label>
		<select class="form-group" name="trajet">
		<?php while ($resPostuler = pg_fetch_array($reqPostuler)){ 
        
            /* On récup les infos du trajet */
            $reqTrajet="select v1.nomV as depart, v2.nomV as dest, t.dateT as date from Trajets t, Villes v1, Villes v2 WHERE t.idT=".$resPostuler['idT']." AND v1.idVille=idVilleDepart AND v2.idVille=idVilleDestination";
            $resTrajet=pg_query($conn, $reqTrajet) or die ('Erreur select l14: '.pg_last_error($conn));
            $trajet=pg_fetch_array($resTrajet);
        
        ?>
					  <option value=<?php echo "'" . $resPostuler['idT']."/".$resPostuler['idConducteur'] . "'"?> ><?php echo  $trajet['depart'] . " → ".$trajet['dest'] . " / " . $resPostuler['idConducteur'] . " / " . date('d/m/Y', $resPostuler['dateT']); ?></option>
		<?php }?>
		</select></p><br>
    <div class="form-group ">
		<p><label for="note" class="col-lg-1">Note :</label>
        <select class="form-group" name="note">
        	<?php 
        	for ($i=0; $i < 6 ; $i++) { 	
        		echo "<option value=".$i." >".$i."</option>";        		
        	}
        	?>
        </select>
        </p></div>
        <br>

        <p><label for="texte" class="col-lg-1">Avis :</label>
		<TEXTAREA class="form-control col-lg-4" style="margin-bottom:20px" name="texte" rows=4 cols=40>C'était super !</TEXTAREA></p>
        <br><br>
		
		<!--bloc contenant le bouton valider-->
		<div>
			<input class="btn btn-lg btn-classique btn-success bouton" type='submit' value='Valider' name='bp_valider' />
		</div>


	</form>
 </div> 
</div>
<?php
}
?>