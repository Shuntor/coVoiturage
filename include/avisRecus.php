<?php

/* Affichage des avis qu'on a reçu */

/*$req="SELECT * FROM Avis WHERE idReceveur = '".$_SESSION['idU']."'";*/

$req="SELECT * FROM Avis WHERE idReceveur = '".$_SESSION['idU'] . "'";

$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));
    while ($res = mysqli_fetch_array($req)){  
    /* On selectionne les infos de l'utilisateur qui a donné la note */
    $reqDonneur="SELECT * FROM CompteUtilisateur WHERE idU = '".$res['idDonneur'] ."'";
    $reqDonneur=mysqli_query($conn, $reqDonneur) or die('Erreur select : '.mysqli_error($conn));
    $donneur=mysqli_fetch_array($reqDonneur);
    
    /* On récup les infos du trajet */
    $reqTrajet="select v1.nomV as depart, v2.nomV as dest, t.dateT as date from trajets t, villes v1, villes v2 WHERE t.idT=".$res['idT']." AND v1.idVille=idVilleDepart AND v2.idVille=idVilleDestination";
    $resTrajet=mysqli_query($conn, $reqTrajet) or die ('Erreur select l14: '.mysqli_error($conn));
    $trajet=mysqli_fetch_array($resTrajet);

    ?>        

    <div class="row marketing">
        <div class="col-lg-12">
            <div class="form-group annonce avis">
                <li >Trajet : <strong><?php echo $trajet['depart'] ?> → <?= $trajet['dest'] ?> (<?= date("d/m/Y", $trajet['date']) ?>)</strong></li>
                <li >Passager : <strong><?php echo $donneur['prenomU']." ".$donneur['nomU']; ?> </strong> <strong>(<?php echo $donneur['idU'] ?>)</strong></li>
                <li >Note : <strong><i><?php echo $res['note']; ?>/5</i></strong></li>
                <p >Commentaire : <br /><i><strong><?php echo $res['texte']; ?></i> </strong></p>
            </div>                 
        </div>
    </div>


    <?php
    }
?>
