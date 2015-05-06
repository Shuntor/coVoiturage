<?php session_start(); 
if (!(empty($_SESSION['id']))&& !(empty($_SESSION['nom']))){
	echo ("Vous êtes connecté sous le nom de <strong>".$_SESSION['nom']."</strong>.");
	?>
	<div><a href=" index.php?p=mesReservations">Mes reservations</a></div>
    <div><a href=" index.php?p=reserverTrajet">Reserver un nouveau trajet</a></div>
	<div><a href=" index.php?p=proposerTrajet">Proposer un trajet</a></div>
	<div><a href=" index.php?p=deco">Deconnexion</a></div>
	<?php 
}else{?>
	<form method="post" action="index.php?p=identification" onSubmit="return verif(this)">
	<table class="tab">
			<tr><td>Identifiant :</td><td> <input type='text' name='id' value='Victor' required/></td></tr>
			<tr><td>Mdp :</td> <td><input type='password' name='mdp' value='blabla' required/></td></tr>
	</table>
			<div>
				<input type='submit' value='Valider' name='bp_valider' >
			</div>
	</form>
	<?php 
	if(isset($_POST["bp_valider"])){
		//Requete permettant de rechercher l'id du client dans la base
		$req="SELECT idU, mdp FROM ComptesUtilisateurs where idU ='".$_POST['id']."'";
		$req=mysql_query($req) or die('Erreur select : '.mysql_error());
		$data=mysql_fetch_array($req);
		if(empty($data)){
			echo ("Identifiant inconnu...");
		}elseif($data['mdp'] != $_POST['mdp']){
			echo ("ID reconnu mais mauvais mdp...");
		}else{
			$_SESSION['id']=$_POST['id'];
			$req="SELECT nomU, prenomU, adresse FROM ComptesUtilisateurs where idclient ='".$_SESSION['id']."'";
			$req=mysql_query($req) or die('Erreur select : '.mysql_error());
			$data=mysql_fetch_array($req);
			echo ("Bravo <strong>".$data['nomU']."</strong>, vous vous êtes connecté !<br/>
				   Vous habitez actuellement <strong>".$data['adresse']."</strong>.<br/>
				   Nous sommes très heureux de vous revoir !");
			$_SESSION['nomU']=$data['nomclient'];
			$_SESSION['adresse']=$data['adresse'];
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'index.php?p=identification';
			header("Location: http://$host$uri/$extra");
			exit;
		}
	}
}

/*  - Ajouter le connect.php
    - 
*/