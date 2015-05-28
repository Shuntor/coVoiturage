<?php
/* 
    TODO: 
      -N'afficher que les trajets du futur.
      -Puis les voyages éffectués

*/

/* Requete sur Postuler, on récupère tous les trajets */ 
$reqPostuler="SELECT * FROM Postuler WHERE idU='".$_SESSION['idU']."';";
$reqPostuler=mysqli_query($conn, $reqPostuler) or die('Erreur select : '.mysqli_error($conn));
if(mysqli_num_rows($reqPostuler)==0){
                    echo "C'est vide !";
}else{
  while ($res = mysqli_fetch_array($reqPostuler)){ 
    $postuler[] = $res;
  }
 

  /* Requete sur Trajet */
  foreach ($postuler as $res) { 
     
      $reqTrajets="SELECT * FROM Trajets where idT=".$res['idT'].";";
      $reqTrajets=mysqli_query($conn, $reqTrajets) or die('Erreur select : '.mysqli_error($conn));
      $trajet=mysqli_fetch_array($reqTrajets);

      
      /* Requete sur CompteUtilisateur */
      $reqCU="SELECT prenomU, nomU FROM CompteUtilisateur WHERE idU='".$trajet['idConducteur']."';";
      $reqCU=mysqli_query($conn, $reqCU) or die('Erreur select : '.mysqli_error($conn));
      $compteUtilisateur=mysqli_fetch_array($reqCU, MYSQLI_ASSOC);

      /* Requete sur les villes */
      $reqVilleD="SELECT * FROM Villes WHERE idVille=".$trajet['idVilleDepart'].";";
      $reqVilleA="SELECT * FROM Villes WHERE idVille=".$trajet['idVilleDestination'].";";
      $reqVilleD=mysqli_query($conn, $reqVilleD) or die('Erreur select : '.mysqli_error($conn));
      $reqVilleA=mysqli_query($conn, $reqVilleA) or die('Erreur select : '.mysqli_error($conn));
      $villeD=mysqli_fetch_array($reqVilleD);
      $villeA=mysqli_fetch_array($reqVilleA);



      ?>
        

           <!--    <h8 class="col-lg-12">Mes prochains voyages </h8> -->
              
              <div class="form-group annonce4 prochainsVoyageDetails col-lg-12">
              <h4><?php echo $villeD['nomV']." > ".$villeA['nomV']  ?></h4>
              <ul >
                <li class="list-unstyled">Conducteur : <?php echo $compteUtilisateur['prenomU']." ".$compteUtilisateur['nomU'] ;?></li>
                <li class="list-unstyled">Point de Rendez-vous : <?php echo $villeD['nomV']." - ".$villeD['cp']; ?></li>
                <li class="list-unstyled">Point d'Arrivée : <?php echo $villeA['nomV']." - ".$villeA['cp']; ?></li>
                <li class="list-unstyled">Date : <?php echo date('d/m/Y', $trajet['dateT']); ?></li>
                <li class="list-unstyled">Heure de Départ : <?php echo $trajet['heureD'] ;?> </li>
                <li class="list-unstyled">Heure d'Arrrivée prévue : <?php echo $trajet['heureA']; ?> </li> 
          </ul>
            <a class="btn btn-lg btn-success bouton" href="?p=trajetDetails&amp;t=<?=$trajet['idT']?>" role="button">Voir Détails...</a></li>
          </div> 
                
                
    
  <?php }
} 

/*print_r($postuler);*/
?>

                 
    
<!-- <div class="row marketing">
    <div class="col-lg-12">
        <div class="form-group annonce voyagesEffectues">
          <h8 class="col-lg-12">Mes voyages effectués </h8>
          <div class="form-group annonce voyagesEffectuesDetails">
          <h4>TOULOUSE > LE MANS</h4>
          <ul >
            <li class="list-unstyled">Conducteur : nicoletta.31000</li>
            <li class="list-unstyled">Point de Rendez-vous : Gare Matabiau, Toulouse 31000</li>
            <li class="list-unstyled">Point d'Arrivée : Gare Routière, Le Mans, 72000</li>
            <li class="list-unstyled">Date : 20/06/2015</li>
            <li class="list-unstyled">Heure de Départ : 14h15 &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; Heure d'Arrrivée prévue : 22h15</li>
            <li class="list-unstyled">Heure d'Arrrivée prévue : 22h15 </li>
          </ul>
          </div>
        </div>
    </div>            
</div> -->

