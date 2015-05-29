    <?php
    /* Nom : resultatRecherche.php
     * Description : On récupère les informations de la recherche, on les traite puis on affiche les resultats
     * Pages appelées : detailTrajet  
     */

    //Si le bouton a recherche a été utilisé et si les champs villeDepart et villeArrivé ont été remplis 
    if(isset($_POST["bp_rechercher"]) && !empty($_POST['villeDepart']) && !empty($_POST['villeDestination'])){
        
        //On selectionne les informations de la ville de Depart (id)
        $reqChercheD="SELECT * FROM Villes WHERE nomV='".$_POST['villeDepart']."';";
        $resChercheD=mysqli_query($conn, $reqChercheD);
        if (($villeD=mysqli_fetch_row($resChercheD)) != NULL)
            $idVilleD=$villeD[0];
        else
            $idVilleD=-1;
        
        //On selectionne les informations de la ville d'arrivée (id)
        $reqChercheA="SELECT * FROM Villes WHERE nomV='".$_POST['villeDestination']."';";
        $resChercheA=mysqli_query($conn, $reqChercheA);
        if (($villeA=mysqli_fetch_row($resChercheA)) != NULL)
            $idVilleA=$villeA[0];
        else
            $idVilleA=-1;
        
        //Si la date n'a pas été remplie on cherche pour toutes les dates
        if (!empty($_POST['date']))
        {
    				//On transforme la date en timestamp
                    date_default_timezone_set('Europe/Paris');
                    $exp_date = str_replace('/', '-', $_POST['date']);
    				$date = strtotime($exp_date);
        //Selection des trajets avec les bonnes informations (Villes + date)
    	$req="SELECT * FROM Trajets WHERE idVilleDepart=".$idVilleD." 
    			AND idVilleDestination=".$idVilleA." 
    			AND dateT BETWEEN ".($date)." AND ".($date+86400).";";
        }
        else
        {
            //Cette fois on selectionne toutes les dates
    	$req="SELECT * FROM Trajets WHERE idVilleDepart=".$idVilleD." 
    			AND idVilleDestination=".$idVilleA.";";
        }

    	$req=mysqli_query($conn, $req) or die('Erreur select : '.mysqli_error($conn));

    ?>
    <h1> Resultat de la recherche : </h1>
     <div class="row marketing">
            <div class="col-lg-6">
    <?php 

        //Tant qu'on a des trajets à afficher
    	while ($res = mysqli_fetch_array($req)){ 
    		/*On va cherchr les informations relatifs au conducteur */
    		$reqConducteur="SELECT * from CompteUtilisateur WHERE idU ='".$res['idConducteur'] . "'";
    		$reqConducteur=mysqli_query($conn, $reqConducteur);
    		$conducteur=mysqli_fetch_array($reqConducteur, MYSQLI_ASSOC);
    		?>
    		<div class="form-group annonce">
              <h4><?php echo $_POST['villeDepart']." > ".$_POST['villeDestination']; ?></h4>
              <ul >
                <li class="list-unstyled">Conducteur : <?php echo $conducteur['nomU']." ".$conducteur['prenomU']  ?></li>
                <li class="list-unstyled">Point de Rendez-vous : <?php echo $_POST['villeDepart'] ?></li>
                <li class="list-unstyled">Point d'Arrivée : <?php echo $_POST['villeDestination'] ?></li>
                <li class="list-unstyled">Date : <?php echo date('d/m/Y', $res['dateT']); ?></li>
                <li class="list-unstyled">Heure de Départ : <?php echo $res['heureD'] ?> </li>
                <li class="list-unstyled">Heure d'Arrrivée prévue : <?php echo $res['heureA'] ?> 
              </ul>
                <a class="btn btn-lg btn-success bouton" href="?p=trajetDetails&amp;t=<?=$res['idT']?>" role="button">Voir Détails...</a></li>
              </div> 
    		<?php
    					// echo "Date : ".$res['dateT']."  Heure de depart : ".$res['heureD']."  Heure d'arrivée : ".$res['heureA'];
    				}


                    
    } else {
    	
    	
    ?>

        <div class="col-lg-12 alert alert-danger">Formulaire de recherche incomplet</div>
        <?php
        }
        ?>
    	</div>
    </div>