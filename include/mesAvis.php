<?php


/*
    Afficher les avis qu'on a reçu
    Afficher les avis qu'on peut faire

*/
/*
INSERT INTO Avis(texte, idDonneur, idReceveur, idT, note) VALUES("SUPER !", 1, 1, 1,3)

*/
?>


<div class="row-fluid">
        <div class="offset2 span8">
            <div class="tabbable">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#0" data-toggle="tab">Donner un avis</a></li>
                    <li><a href="#1" data-toggle="tab">Avis reçus</a></li>
                    <li><a href="#2" data-toggle="tab">Avis donnés</a></li>
                 
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="0"><?php include("donnerAvis.php"); ?></div>
                    <div class="tab-pane active" id="1"><?php include("avisRecus.php");  ?></div>
                    <div class="tab-pane" id="2"><?php include("avisDonnes.php"); ?></div>

                </div>
            </div>
        </div>
    </div>
