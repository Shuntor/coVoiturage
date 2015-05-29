<!--
    * Nom:avisDonnees.php
    
    * Description: contenu de l'onglet "Avis Donnés", permettant à l'utilisateur de voir les avis qu'il a donné
    
    * Pages appelées: 
-->
<div class="annonce3 col-lg-12">
<?php

/* vérif si un avis est présent dans la base données */

$reqAvis="SELECT * FROM Avis;";
$reqAvis=mysqli_query($conn, $reqAvis) or die('Erreur select : '.mysqli_error($conn));
if(mysqli_num_rows($reqAvis)==0){
                    echo "<p class=\"lead\"> Vous n'avez donné aucun avis </p>";
}
/* Affichage des avis qu'on a donné */



$req="SELECT * FROM Avis WHERE idDonneur = '".$_SESSION['idU'] . "'";
$req=mysqli_query($conn, $req) or die('Erreur select l5: '.mysqli_error($conn));
?>

    <div class="page-header">
        <h1>Les avis que vous avez donné : </h1>
        <p class="lead">N'hésitez pas à dire ce que vous avez pensé des conducteurs ! </p>
    </div>          
<?php
    
    while ($res = mysqli_fetch_array($req)){  
    /* On selectionne les infos de l'utilisateur qui a reçu la note */
    $reqReceveur="SELECT * FROM CompteUtilisateur WHERE idU = '".$res['idReceveur'] . "'";
    $reqReceveur=mysqli_query($conn, $reqReceveur) or die('Erreur select l9: '.mysqli_error($conn));
    $receveur=mysqli_fetch_array($reqReceveur);
    
    /* On récupère les infos du trajet */
    $reqTrajet="select v1.nomV as depart, v2.nomV as dest, t.dateT as date from Trajets t, Villes v1, Villes v2 WHERE t.idT=".$res['idT']." AND v1.idVille=idVilleDepart AND v2.idVille=idVilleDestination";
    $resTrajet=mysqli_query($conn, $reqTrajet) or die ('Erreur select l14: '.mysqli_error($conn));
    $trajet=mysqli_fetch_array($resTrajet);
    
    ?> 
    <div class="row marketing col-lg-12">
        <div class="col-lg-12">
            <div class="form-group annonce5 avis col-lg-12">
                <li >Trajet : <strong><?php echo $trajet['depart'] ?> → <?= $trajet['dest'] ?> (<?= date("d/m/Y", $trajet['date']) ?>)</strong></li>
                <li >Conducteur : <strong><?php echo $receveur['prenomU']." ".$receveur['nomU']; ?> </strong> <strong>(<?php echo $receveur['idU'] ?>)</strong></li>
                <li >Note : <strong><i><?php echo $res['note']; ?>/5</i></strong></li>
                <p >Commentaire : <br /><i><strong><?php echo $res['texte']; ?></i> </strong></p>
            </div>                 
        </div>
    </div>


    <?php
    }

?>
</div>