<?php
/*
    * Nom:mesAvis.php
    
    * Description: Page avec les onglets permettant de choisir entre les menus: donnerAvis // avisRecus // avisDonnes
    
    * Pages appelées: donnerAvis.php // avisRecus.php // avisDonnes.php
*/


?>


<div class="row-fluid">
        <div class="offset2 span8">
            <div class="tabbable">
                <div class="col-lg-3"></div>
                <center><strong><ul class="nav nav-tabs nav-justified col-lg-6 barreAvis">
                    <!-- Affichage des onglets -->
                    <li class="active" class="bouton1"><a class="btnBarreAvis" href="#0" data-toggle="tab">Donner un avis</a></li>
                    <li><a href="#1" data-toggle="tab">Avis reçus</a></li>
                    <li><a href="#2" data-toggle="tab">Avis donnés</a></li>
                 
                </ul></strong></center>
                <div class="tab-content">
                    <!-- redirections des onglets -->
                    <div class="tab-pane active" id="0"><?php include("donnerAvis.php"); ?></div>
                    <div class="tab-pane " id="1"><?php include("avisRecus.php");  ?></div>
                    <div class="tab-pane" id="2"><?php include("avisDonnes.php"); ?></div>

                </div>
            </div>
        </div>
    </div>
