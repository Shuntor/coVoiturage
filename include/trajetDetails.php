<?php

$trajet=false;

if(isset($_GET['t']))
{
    $res=mysqli_query($conn, "select * from Trajets where idT='".mysqli_real_escape_string($conn, $_GET['t'])."'");
    $trajet=mysqli_fetch_array($res);
}

if(!$trajet)
{
    ?>
    <div class="col-lg-12 alert alert-danger">ID du trajet invalide !</div>
    <?php
}
else
{
    if(isset($_POST['Postuler']) && isset($_SESSION['idU']))
    {
        $req="INSERT INTO Postuler (nbPlace, idU, idT) VALUES (1, '".$_SESSION['idU']."',".$_GET['t'].")";
        $res=mysqli_query($conn, $req) or die ('Erreur insert Postulation : '. mysqli_error($conn));
        ?>
        <div class="col-lg-12 alert alert-success">Vous avez bien postulé sur ce trajet !</div>
        <?php
    }
    
    $reqConducteur="SELECT * FROM compteUtilisateur WHERE idU='" . $trajet['idConducteur'] . "'";
    $resConducteur=mysqli_query($conn, $reqConducteur) OR die('Erreur select conducteur : ' . mysqli_error($conn));
    $conducteur=mysqli_fetch_array($resConducteur);
    
    $reqVilleDepart = "SELECT * FROM Villes WHERE idVille='" . $trajet['idVilleDepart'] . "'";
    $resVilleDepart = mysqli_query($conn, $reqVilleDepart) OR die ('Erreur select villeDepart : ' . mysqli_error($conn));
    $villeDepart = mysqli_fetch_array($resVilleDepart);
    
    $reqVilleArrivee = "SELECT * FROM Villes WHERE idVille='" . $trajet['idVilleDestination'] . "'";
    $resVilleArrivee = mysqli_query($conn, $reqVilleArrivee) OR die ('Erreur select villeArrivee : ' . mysqli_error($conn));
    $villeArrivee = mysqli_fetch_array($resVilleArrivee);
    
    $reqVoiture = "SELECT * FROM Voitures WHERE idV='" . $trajet['idVoiture'] . "'";
    $resVoiture = mysqli_query($conn, $reqVoiture) OR die ('Erreur select voiture : ' . mysqli_error($conn));
    $voiture = mysqli_fetch_array($resVoiture);
    
    ?>
    

      <div class="row">
        <div class="col-lg-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Carte</h3>
            </div>
            <div class="panel-body">
              Google maps
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><strong><?=$villeDepart['nomV']?> &rArr; <?=$villeArrivee['nomV']?></strong></h3>
            </div>
            <div class="panel-body">
                <ul>
                <li class="list-unstyled">Date : <strong><?=date('d/m/Y', $trajet['dateT']); ?></strong></li><br/>
                <li class="list-unstyled">Ville de départ : <strong><?=$villeDepart['nomV']?></strong></li>
                <li class="list-unstyled">Heure de départ : <strong><?=$trajet['heureD'] ?></strong></li><br/>
                <li class="list-unstyled">Ville d'arrivée : <strong><?=$villeArrivee['nomV']?></strong></li>
                <li class="list-unstyled">Heure d'arrrivée prévue : <strong><?=$trajet['heureA'] ?> </strong></li>
                </ul>
            </div>
          </div>
        </div>
        
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Voiture</h3>
            </div>
            <div class="panel-body">
                <ul>
                <li class="list-unstyled">Marque : <strong><?=$voiture['marque']?></strong></li>
                <li class="list-unstyled">Couleur : <strong><?=$voiture['couleur']?></strong></li>
                <li class="list-unstyled">Année : <strong><?=$voiture['annee'] ?></strong></li>
                <li class="list-unstyled">Nombre de places : <strong><?=$voiture['nbPLace']?></strong></li>
                </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Conducteur</h3>
            </div>
            <div class="panel-body">
                <ul>
                <li class="list-unstyled"><strong><?=$conducteur['prenomU']?> <?=$conducteur['nomU']?> (<?=$conducteur['idU']?>)</strong></li>
                <li class="list-unstyled">Genre : <strong><?= $conducteur['genre'] == 'm' ? 'Homme' : 'Femme' ?></strong></li>
                <li class="list-unstyled">Age : <strong><?=$conducteur['age'] ?> ans</strong></li>
                <li class="list-unstyled">Moyenne : <strong><?=$conducteur['moyenne'] == '' ? '-' : $conducteur['moyenne']?>/5</strong></li>
                <li class="list-unstyled">Pays : <strong><?=$conducteur['pays']?></strong></li>
                <li class="list-unstyled">Téléphone : <strong>0<?=$conducteur['telephone']?></strong></li>
                </ul>
            </div>
          </div>
        </div>
        
      </div>
      <div class="col-lg-12">
      <?php
      if(isset($_SESSION['idU']))
      {
          // On vérifie si on a pas déjà postulé à ce trajet
          $req="SELECT 1 FROM Postuler WHERE idU='".$_SESSION['idU']."' AND idT='".$_GET['t']."'";
          $res=mysqli_query($conn, $req) or die ('Erreur select postuler ligne 102 : '. mysqli_error($conn));
          if(mysqli_num_rows($res) != 0)
          {
              ?>
          <div class="alert alert-info">Vous avez déjà postulé à ce trajet !</div>
          <?php
          }
          
          // On vérifie si on est pas le conducteur
          else if ($conducteur['idU'] == $_SESSION['idU'])
          {
              
              ?>
          <div class="alert alert-info">Vous êtes le conducteur de ce trajet !</div>
          <?php
          }
          else
          {
              
              
          ?>
      <form method="post" action="?p=trajetDetails&amp;t=<?=$_GET['t']?>">
        <button type="submit" name="Postuler" class="btn btn-xl btn-success" id="submit" />Postuler à ce trajet !</button>
      </form>
      <?php
          }
      }
      else
      {
          ?>
          <div class="alert alert-danger">Vous devez être connecté pour postuler à un trajet !</div>
          <?php
      }?>
      </div>
    <?php
}
?>