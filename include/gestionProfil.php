
 <!--<!DOCTYPE html> -->
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Site de covoiturage étudiant">
    <meta name="VJMQ" content="">
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

      <div class="row marketing">
        <div class="col-lg-12">
          <div class="form-group annonce">
          <h4>Gerer Mon Profil...</h4>
          <ul >
            <form method="post" action="traitement.php" class="col-lg-8">
        
                <p><label for="nom" class="col-lg-3">Nom :</label>
                <input type="text" name="nom" id="nom" /></p>
                <br><br>
                
                <p><label for="prenom" class="col-lg-3">Prénom :</label>
                <input type="password" name="prenom" id="prenom" /></p>
                <br><br>
                
                <p><label for="adresse" class="col-lg-3">Adresse :</label>
                <input type="text" name="adresse" id="adresse" /></p>
                <br><br>
                
                <p><label for="pays" class="col-lg-3">Pays :</label>
                <input type="text" name="pays" id="pays" /></p>
                <br><br>
                
                <p><label for="dateNaissance" class="col-lg-3">Date de naissance :</label>
                <input type="text" name="dateNaissance" id="dateNaissance" /></p>
                <br><br>
                
                <p><label for="sexe" class="col-lg-3">Sexe :</label>
                <input type="text" name="sexe" id="sexe" /></p>
                <br><br>
                
                <p><label for="mail" class="col-lg-3">Adresse e-mail :</label>
                <input type="text" name="mail" id="mail" /></p>
                <br><br>
                
                <h5>Changer Mot de Passe:</h5>
                <p><label for="ancienMdp" class="col-lg-3">Ancien Mot de Passe :</label>
                <input type="text" name="ancienMdp" id="ancienMdp" /></p>
                <p><label for="nouveauMdp" class="col-lg-3">Nouveau Mot de Passe :</label>
                <input type="text" name="nouveauMdp" id="nouveauMDP" /></p>
                <p><label for="conMdp" class="col-lg-3">Ancien Mot de Passe :</label>
                <input type="text" name="confMdp" id="confMdp" /></p>
                <br><br>
                
            </form>
            
              
              
          </ul>
          </div>                 
        </div>
      </div>

      <footer class="footer">
        <p>&copy; Company 2014</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

