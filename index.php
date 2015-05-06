<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Site de covoiturage étudiant">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CovoiturageEtudiant.com</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <?php include 'connect.php';/*include 'fonctions.php'; session_start(); */?>


   <div class="container">
      <div class="header">
        
        <div class="form-group col-lg-12 cadre_logo">
          <h3 class="logo"><img src="images/logo2.png" alt="Acceuil du site" href="?p=" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Covoiturage-Etudiant.com</h3>
            <ul class="nav pull-right">
            <?php if (!(isset($_SESSION['login']))){?>
              <a class="btn btn-lg btn-success bouton boutonConnexion connexion " href="?p=identification" role="button">Se Connecter!</a>
              <a class="btn btn-lg btn-success bouton boutonConnexion " href="?p=inscription" role="button">S'inscrire!</a>
            <?php }else{ ?>
              <a class="btn btn-lg btn-success bouton boutonConnexion connexion " href="deconnexion.html" role="button">Se Deconnecter!</a>
            <?php } ?>
            </ul>
        </div>
      </div>
      <div class="container">

       <?php 
        if(empty($_GET['p']))
          {include("./include/accueil.php");}
        else if($_GET['p']=='admin')
          {include("./include/admin.php");}
        else if($_GET['p']=='gestionProfil')
          {include("./include/gestionProfil.php");}
        else if($_GET['p']=='mesAvis')
          {include("./include/mesAvis.php");}
        else if($_GET['p']=='mesReservations')
          {include("./include/mesReservations.php");}
        else if($_GET['p']=='mesTrajets')
          {include("./include/mesTrajets.php");}
        else if($_GET['p']=='proposerTrajet')
          {include("./include/proposerTrajet.php");}
        else if($_GET['p']=='resultatRecherche')
          {include("./include/resultatRecherche.php");}
        else if($_GET['p']=='trajetDetails')
          {include("./include/trajetDetails.php");}
        else if($_GET['p']=='connexion')
          {include("./include/connexion.php");}
        else if($_GET['p']=='inscription')
          {include("./include/inscription.php");}
        else if($_GET['p']=='identification')
          {include("./include/identification.php");}
      ?>
     

      </div>




      <footer class="footer">
        <p>&copy; STRI 2015</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
