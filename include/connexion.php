<?php 
/* Nom : connexion.php
 * Description : Page traitant les informations de connexion
 * Pages appelées : Redirection vers l'accueil
 */


//Si le bouton valider de la connexion a été activé
if(isset($_POST["bp_valider"])){
		//Requete permettant de rechercher l'id du client dans la base
		$req="SELECT idU, mdp, mail FROM CompteUtilisateur where mail ='".$_POST['mail']."'";
		$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));
		$data=mysqli_fetch_array($req);

		//Si il ne trouve pas l'identifiant
		if(empty($data)){
            echo "<h2>Identifiant inconnu...</h2>";
            echo "<a href='http://$host$uri/$extra'>Retour à l'accueil</a>";
		}elseif($data['mdp'] != $_POST['mdp']){ //Si il ne trouve pas le mot de passe correspondant
            echo "<h2>ID reconnu mais mauvais mot de passe...</h2>";
            echo "<a href='http://$host$uri/$extra'>Retour à l'accueil</a>";
		}else{
			$_SESSION['idU']=$data['idU']; // Si il a tout trouvé, on peut remplir les variables SESSION
			$req="SELECT nomU, prenomU FROM CompteUtilisateur where idU ='".$_SESSION['idU']."'";
			$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));
			$data=mysqli_fetch_array($req);
			echo ("<h2>Bravo <strong>".$data['prenomU']."</strong>, vous vous êtes connecté !</h2>
				   Nous sommes très heureux de vous revoir !<br/>");
            echo "<a href='http://$host$uri/$extra'>Retour à l'accueil</a>";
			$_SESSION['nomU']=$data['nomU'];
			$_SESSION['prenomU']=$data['prenomU'];
			//header("Location: http://$host$uri/$extra");
            echo "<script>window.location.replace('http://$host$uri/$extra');</script>";
			exit;
		}
	}
	//Redirection vers l'accueil
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php?p=';

?>