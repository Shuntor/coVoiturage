<?php

/* Affichage des avis qu'on a donné */
$req="SELECT * FROM Avis WHERE idDonneur = '".$_SESSION['idU']."'";
$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));
    while ($res = mysqli_fetch_array($req)){  
    /* On selectionne les infos de l'utilisateur qui a donné la note */
    $reqDonneur="SELECT * FROM CompteUtilisateur WHERE idU = ".$res['idDonneur'];
    $reqDonneur=mysqli_query($conn, $reqDonneur) or die('Erreur select : '.mysqli_error($conn));
    $donneur=mysqli_fetch_row($reqDonneur);

    ?>        

    <div class="row marketing">
        <div class="col-lg-12">
            <div class="form-group annonce avis">
                <li ><strong> <?php echo $donneur[1]." ".$donneur[2]; ?> </strong></li>
                <li ><i> note : <?php echo $res['note']; ?>/5</i></li>
                <p ><?php echo $donneur['nomU'] ?><i><?php echo $res['texte']; ?></i> </p>
            </div>                 
        </div>
    </div>


    <?php
    }
?>