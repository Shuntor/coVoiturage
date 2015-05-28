<?php 


			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'index.php?p=';

if(isset($_POST["bp_valider"])){
		//Requete permettant de rechercher l'id du client dans la base

		// $req="SELECT * FROM CompteUtilisateur";
		// $req=pg_query($conn, $req) or die('Erreur select : '.pg_last_error($conn));
		// $data=pg_fetch_array($req);
		// echo $data['prenomU'];
        // echo "</br>";



		$req="SELECT idU, mdp, mail FROM CompteUtilisateur where mail ='".$_POST['mail']."'";
		$req=pg_query($conn, $req) or die('Erreur select : '.pg_last_error($conn));
		$data=pg_fetch_array($req);
		if(empty($data)){
            echo "<h2>Identifiant inconnu...</h2>";
            echo "<a href='http://$host$uri/$extra'>Retour à l'accueil</a>";
		}elseif($data['mdp'] != $_POST['mdp']){
            echo "<h2>ID reconnu mais mauvais mot de passe...</h2>";
            echo "<a href='http://$host$uri/$extra'>Retour à l'accueil</a>";
		}else{
            print_r($data);
			$_SESSION['idU']=$data['idU'];
			$req="SELECT nomU, prenomU FROM CompteUtilisateur where idU ='".$_SESSION['idU']."'";
			$req=pg_query($conn, $req) or die('Erreur select : '.pg_last_error($conn));
			$data=pg_fetch_array($req);
			echo ("<h2>Bravo <strong>".$data['prenomU']."</strong>, vous vous êtes connecté !</h2>
				   Nous sommes très heureux de vous revoir !<br/>");
            echo "<a href='http://$host$uri/$extra'>Retour à l'accueil</a>";
			$_SESSION['nomU']=$data['nomU'];
			$_SESSION['prenomU']=$data['prenomU'];
			//header("Location: http://$host$uri/$extra");
            //echo "<script>window.location.replace('http://$host$uri/$extra');</script>";
			exit;
		}
	}

?>