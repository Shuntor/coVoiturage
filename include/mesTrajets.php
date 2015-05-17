
<?php
	if(isset($_POST["bp_valider"]))
			{

				echo $_POST['dateTrajet']." - ".$_POST['lieuDepart']." - ".$_POST['hD']." - ".$_POST['lieuArrivee']." - ".$_POST['hA']." - ".$_POST['voiture'];


				//On transforme la date en timestamp
				$timestamp = strtotime($_POST['dateTrajet']);

				//requete permettant d insérer le trajet dans la base de donnée
				$requete="insert into Trajets(dateT, heureD, heureA, idVilleDestination, idVilleDepart, idConducteur) values('".$timestamp."','".$_POST['hD']."','".$_POST['hA']."','".$_POST['lieuDepart']."','".$_POST['lieuArrivee']."','".$_SESSION['idU']."')";
				$resultat = mysqli_query($conn, $requete) OR die('Erreur insertion : '.mysqli_error($conn));

				?>

				<!-- Il faut décorer ça  -->
				<strong> Saisie enregistrée ! </strong><br>
				<a href="index.php?p="> Retourner à l'accueil </a>
				
				
								
				<?php
			}else{
				$req="SELECT * FROM Voitures WHERE idU=".$_SESSION['idU'];
				$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));
				/*$res=mysqli_fetch_array($req);*/
				$reqVilles="SELECT * FROM Villes ;";
				$reqVilles=mysqli_query($conn, $reqVilles) or die('Erreur select : '.mysqli_error($conn));
				while ($res = mysqli_fetch_array($reqVilles)){ 
					$villes[] = $res;
				}
?>					

						<!-- création du formulaire de saisie -->


<legend>Saisie d'un trajet</legend>
	<form method="post" action="index.php?p=mesTrajets" onSubmit="return verif(this)">

		<center><table class="table table-bordered">
		<caption>Saisie des informations du trajet de <?php echo $_SESSION["prenomU"]." ".$_SESSION["nomU"]; ?> </caption>
		<tr><td>Quel jour souhaitez vous voyager ? <input type="date" name="dateTrajet"></td></tr>
		<tr><td>Lieu de départ :</td>
			<td>
				<select class="form-control" name="lieuDepart">
				<?php foreach ($villes as $res) {?>
							  <option value=<?php echo $res['idVille']; ?> ><?php echo $res['nomV']." - ".$res['cp']; ?></option>
				<?php }?>
			</select></td>
			<td>Heure : <input type="time" name="hD" value""></td>
		</tr>
		
		<tr><td>Lieu d'arrivée :</td>
			<td>
				<select class="form-control" name="lieuArrivee">
				<?php foreach ($villes as $res) {?>
							  <option value=<?php echo $res['idVille']; ?> ><?php echo $res['nomV']." - ".$res['cp']; ?></option>
				<?php }?>
			</select></td>
			<td>Heure : <input type="time" name="hA"></td>
		</tr>
		<tr><td>Voiture : </td><td>
			<select class="form-control" name="voiture">
			<?php while ($res = mysqli_fetch_array($req)){ ?>
						  <option value=<?php echo $res['idV']; ?> ><?php echo $res['marque']." ".$res['couleur']." (".$res['nbPLace'].")"; ?></option>
			<?php }?>
			</select></td>
		</tr>
		</table>
		
		<!--bloc contenant le bouton valider-->
		<div>
			<input type='submit' value='Valider' name='bp_valider' />
		</div>
	</form>

	<?php
}?>