<?php 

if(isset($_POST["bp_valider"])){
		//Requete permettant de rechercher l'id du client dans la base

		$req="SELECT * FROM CompteUtilisateur";
		$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));
		$data=mysqli_fetch_array($req);
		echo $data['prenomU'];



		$req="SELECT idU, mdp, mail FROM CompteUtilisateur where mail ='".$_POST['mail']."'";
		$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));
		$data=mysqli_fetch_array($req);
		if(empty($data)){
			echo ("Identifiant inconnu...");
		}elseif($data['mdp'] != $_POST['mdp']){
			echo ("ID reconnu mais mauvais mdp...");
		}else{
			$_SESSION['idU']=$data['idU'];
			$req="SELECT nomU, prenomU FROM CompteUtilisateur where idU ='".$_SESSION['idU']."'";
			$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));
			$data=mysqli_fetch_array($req);
			echo ("Bravo <strong>".$data['prenomU']."</strong>, vous vous êtes connecté !<br/>
				   Nous sommes très heureux de vous revoir !");
			$_SESSION['nomU']=$data['nomU'];
			$_SESSION['prenomU']=$data['prenomU'];
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'index.php?p=';
			header("Location: http://$host$uri/$extra");
			exit;
		}
	}

?>