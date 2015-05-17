
<?php
	if(isset($_POST["bp_valider"]))
			{
				//requete permettant d insérer le trajet dans la base de donnée
				$requete="insert into client values(NULL,'".$_POST['nom']."','".$_POST['adresse']."','".$_POST['tel']."','".$_POST['mail']."')";
				$resultat = mysql_query($requete) OR DIE ("Erreur, probleme de requete sur client");
				
				
				$requete4="SELECT LAST_INSERT_ID() FROM client ";
				$resultat4 = mysql_query($requete4) OR DIE ("Erreur, probleme de requete4");
				$ligne2 = mysql_fetch_array($resultat4);
				
				//requete permettant d'enregistrer la demande de visite dans la base de donnée
				$datenow=date("Y-m-d H:i:s");
				$requete2="insert into demande values(NULL,'".$datenow."' ,'".$_POST['dispo']."', LAST_INSERT_ID())";
				$resultat2 = mysql_query($requete2) OR DIE ("Erreur, probleme de requete lors de l'insertion dans la base demande. ");
		
				$demande="SELECT LAST_INSERT_ID() FROM demande ";
				$resultat5 = mysql_query($demande) OR DIE ("Erreur, probleme de requete5");
				$ligne3 = mysql_fetch_array($resultat5);
				
				//Insertion dans Visiter
				$requeteVis = "insert into visiter values('".$_POST['idbien']."','".$ligne3['LAST_INSERT_ID()']."',1)";
				$resReqVis=mysql_query($requeteVis) OR DIE ("Erreur, probleme de requete lors de l'insertion dans la base Visite. ");
				
								
				
			}
?>					




						<!-- création du formulaire de saisie -->


<legend>Saisie d'un trajet</legend>
	<form method="post" action="index.php?p=mesTrajets" onSubmit="return verif(this)">

		<center><table class="table table-bordered">
		<caption>Saisie des informations du trajet de <?php echo $SESSION_["prenomU"]." ".$SESSION_["nomU"] ?> </caption>
		<tr><td>Quel jour souhaitez vous voyager ? <input type="date" name="dateTrajet"></td></tr>
		<tr><td>Lieu de départ</td><td> <input type='text' name='lieuDepart' required/></td><td>Heure : <input type="time" name="hD"></td></tr>
		
		<tr><td>Lieu d'arrivée :</td><td> <input type='text' name='lieuArrivee' required /></td><td>Heure : <input type="time" name="hA"></td></tr>
		
		<tr><td>Voiture</td><td> <input type='text' name='voit' required/></td></tr>
		
		</table>
		
		<!--bloc contenant le bouton valider-->
		<div>
			<input type='submit' value='Valider' name='bp_valider' />
		</div>
	</form>