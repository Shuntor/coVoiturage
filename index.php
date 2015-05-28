<?php session_start(); ?>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>    
	<script> $.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
    closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
    prevText: '&lt;Préc', prevStatus: 'Voir le mois précédent',
    nextText: 'Suiv&gt;', nextStatus: 'Voir le mois suivant',
    currentText: 'Courant', currentStatus: 'Voir le mois courant',
    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
    'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
    monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
    'Jul','Aoû','Sep','Oct','Nov','Déc'],
    monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',
    weekHeader: 'Sm', weekStatus: '',
    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
    dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
    dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
    dateFormat: 'dd/mm/yy', firstDay: 1, 
    initStatus: 'Choisir la date', isRTL: false};
 $.datepicker.setDefaults($.datepicker.regional['fr']);
		$(function() {
			$("#datepicker").datepicker();
		});
	</script>
    <script>
     $(function(){     
    var input = document.getElementById('ville');
    var input2 = document.getElementById('ville2');         
    var autocomplete = new google.maps.places.Autocomplete(input, {
        types: ["(cities)"]
    });                   
    var autocomplete2 = new google.maps.places.Autocomplete(input2, {
        types: ["(cities)"]
    });          
    
    var infowindow = new google.maps.InfoWindow(); 
    
    $("input").focusin(function () {
        $(document).keypress(function (e) {
            if (e.which == 13) {
                infowindow.close();
                var firstResult = $(".pac-container .pac-item:first").text();
                
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({"address":firstResult }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        $("input").val(firstResult);
                    }
                });
            }
        });
    });
    
    $("input2").focusin(function () {
        $(document).keypress(function (e) {
            if (e.which == 13) {
                infowindow.close();
                var firstResult = $(".pac-container .pac-item:first").text();
                
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({"address":firstResult }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        $("input2").val(firstResult);
                    }
                });
            }
        });
    });
});


</script>
    <title>CovoiturageEtudiant.com</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/ico" href="static/images/favicon.ico" />

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


  <?php include 'connect.php';/*include 'fonctions.php'; */ ?>
<?php 
 
?>



   <div class="container">
      <div class="header">
        
        <div class="form-group col-lg-12 cadre_logo">
          <h3 class="logo"><a href="index.php?p="> <img src="static/images/logo2.png" alt="Acceuil du site" /> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Covoiturage-Etudiant.com</h3>
         <!-- Cas d'un visiteur -->  
          <?php if (!(isset($_SESSION['idU']))){?> 
          <!-- <ul class="nav navVisiteur">     -->
            <nav>     

              <ul class="nav  nav-justified barreIndex">
               <li><a class= "boutonNav" href="#" data-placement="bottom" data-toggle="popover" data-title="Login" data-container="body" type="button" data-html="true" role="button" id="login">Se Connecter!</a></li>
                <div id="popover-content" class="hide">
                  <form class="form-inline" role="form" method="post" action="index.php?p=connexion" onSubmit="return verif(this)">
                      <div class="form-group">
                          <label for="mail" class="col-lg-12" >Adresse e-mail :</label>
                          <input placeholder="adresseMail" class="form-control" maxlength="30" type="text" name="mail">
                      </div>
                          <br><br>
                      <div class="form-group">
                          <label for="password" class="col-lg-12" >Mot de Passe :</label>
                          <input placeholder="Password" class="form-control" maxlength="30" type="password" name="mdp">
                      </div>
                          <br><br>
                          <button type="submit" class="btn boutonConnexion" name="bp_valider">Se connecter! »</button>                                  
                      
                  </form>
              </div>
              <li><a class= "boutonNav" href="?p=inscription">S'inscrire!</a></li>
            </ul>
           </nav>

          <!-- </ul> -->
            <?php }else{ ?>
                
                
         <nav>     
          <ul class="nav nav-justified right navhh">
            <li><a class= "boutonNav" href="index.php?p=">Accueil</a></li>
            <li><a class= "boutonNav" href="?p=gestionProfil">Mon Compte</a></li>
            <li><a class= "boutonNav" href="?p=mesTrajets">Mes Trajets</a></li>
            <li><a class= "boutonNav" href="?p=mesReservations">Mes Réservations</a></li>
            <li><a class= "boutonNav" href="?p=mesAvis">Mes Avis</a></li>
            <li><a class= "boutonNav" href="?p=deconnexion">Se Deconnecter!</a></li>
          </ul>
         </nav>  
            <?php } ?>
            
        </div>
      </div>
      <div class="container">
<!-- ___________________________________________________________________________________________________________________________________________________ -->
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
        else if($_GET['p']=='deconnexion')
          {include("./include/deconnexion.php");}
        else if($_GET['p']=='contact')
          {include("./include/contact.php");}
        else if($_GET['p']=='faq')
          {include("./include/faq.html");}
        else if($_GET['p']=='qsn')
          {include("./include/qsn.html");}
      ?>
<!-- ___________________________________________________________________________________________________________________________________________________ -->
</div>

      <footer class="footer">
        <p>&copy; STRI 2015 </p>
          <p><a href="?p=faq">FAQ </a> | <a href="?p=qsn">Qui sommes-nous? </a> | <a href="">Nous contacter </a>  </p>
        <?php
            if (isset($_SESSION['idU']))
                echo "Vous êtes connecté en tant que : <strong>".$_SESSION['prenomU']." - ".$_SESSION['nomU']."</strong>";
            else
                echo "Vous n'êtes pas connecté";
            ?>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<!-- Script du volet connexion -->
<script>
$("[data-toggle=popover]").popover({
    html: true, 
	content: function() {
          return $('#popover-content').html();
        }
});
</script>

<!-- Script des volets Date -->
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
</script>
