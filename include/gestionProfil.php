<?php

// TODO : tests des valeurs + garder le zéro devant le CP

if (!isset($_SESSION['idU']))
    header ("Location: index.php");

$query = "SELECT *
FROM CompteUtilisateur
WHERE idU = '".addslashes($_SESSION['idU']) . "';";

$result = mysqli_query($conn,$query) or die (mysqli_error($conn));

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$utilisateur = $row;

$modifValides = TRUE;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['infos']))
    {
        // prenom
        if (empty($_POST['prenom']))
        {
            echo "Prenom vide !<br/>";
            $modifValides = FALSE;
        }
        
        //nom
        if (empty($_POST['nom']))
        {
            echo "Nom vide !<br/>";
            $modifValides = FALSE;
        }
        
        //pays
        if (empty($_POST['pays']))
        {
            echo "Payse vide !<br/>";
            $modifValides = FALSE;
        }
        
        //genre
        if (empty($_POST['genre']))
        {
            echo "Genre vide !<br/>";
            $modifValides = FALSE;
        }
        
        //mail
        if (empty($_POST['mail']))
        {
            echo "Mail vide !<br/>";
            $modifValides = FALSE;
        }
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
        {
            echo "Mail invalide !<br />";
            $modifValides = FALSE;
        }
        
        //telephone
        if (empty($_POST['telephone']))
        {
            echo "Téléphone vide !<br/>";
            $modifValides = FALSE;
        }
        
        //age
        if (empty($_POST['age']))
        {
            echo "Age vide !<br />";
            $modifValides = FALSE;
        }
        if (!filter_var($_POST['age'], FILTER_VALIDATE_INT) || $_POST['age'] < 0 || $_POST['age'] > 200)
        {
            echo "Age invalide !<br />";
            $modifValides = FALSE;
        }
        
        //mdp
        if (!empty($_POST['nouveauMdp']))
        {
            if ($_POST['ancienMdp'] != $utilisateur['mdp'])
            {
                echo "Ancien mot de passe invalide !<br />";
                $modifValides = FALSE;
            }
            if ($_POST['nouveauMdp'] != $_POST['confMdp'])
            {
                echo "Il y a une erreur de frappe dans le nouveau mot de passe !<br />";
                $modifValides = FALSE;
            }
        }
        
        if ($modifValides)
        {
            $query  = "UPDATE CompteUtilisateur SET ";
            $query .= "nomU='" . addslashes($_POST['nom']) . "', ";
            $query .= "prenomU='" . addslashes($_POST['prenom']) . "', ";
            $query .= "age='" . addslashes($_POST['age']) . "', ";
            $query .= "genre='" . addslashes($_POST['genre']) . "', ";
            $query .= "pays='" . addslashes($_POST['pays']) . "', ";
            $query .= "mail='" . addslashes($_POST['mail']) . "', ";
            if (!empty($_POST['nouveauMdp']))
                $query .= "mdp='" . addslashes($_POST['nouveauMdp']) . "', ";
            $query .= "telephone='" . addslashes($_POST['telephone']) . "' ";
            $query .= "WHERE idU='" . $_SESSION['idU'] . "';";
            
            mysqli_query($conn,$query) or die (mysqli_error($conn));
            //print_r($result);
            echo "Modifications effectués !";
        }
        else
            echo "Aucune modification effectué !";
    }
    else if (isset($_POST['voiture']))
    {
        $query = "INSERT INTO Voitures (couleur, marque, nbPlace, annee, idU) VALUES (";
        $query .= "'" . addslashes($_POST['couleur']) . "', ";
        $query .= "'" . addslashes($_POST['marque']) . "', ";
        $query .= "'" . addslashes($_POST['nbPlace']) . "', ";
        $query .= "'" . addslashes($_POST['annee']) . "', ";
        $query .= "'" . ($_SESSION['idU']) . "');";
        mysqli_query($conn,$query) or die (mysqli_error($conn));
        ?>
        <div class="col-lg-12 alert alert-success">Voiture inséré avec succés !</div>
        <?php
    }
}
    
$query = "SELECT *
FROM CompteUtilisateur
WHERE idU = '".addslashes($_SESSION['idU']) . "';";

$result = mysqli_query($conn,$query) or die (mysqli_error($conn));

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$utilisateur = $row;


/*
echo '<pre>';
print_r($result);
print_r($utilisateur);
print_r($_SESSION);
print_r($_SERVER);
print_r($_POST);
echo '</pre>';
*/

?>

      <div class="row marketing">
        <div class="col-lg-12">
          <div class="form-group annonce">
          <h6>Gerer Mon Profil...</h6>
          <ul >
            <form method="post" action="?p=gestionProfil">
        
                <p><label for="nom" class="col-lg-2">Nom :</label>
                <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($utilisateur['nomU']) ?>"/></p>
                <br>
                
                <p><label for="prenom" class="col-lg-2">Prénom :</label>
                <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($utilisateur['prenomU']) ?>"/></p>
                <br>
                
                <p><label for="pays" class="col-lg-2">Pays :</label>
                <input type="text" name="pays" id="pays" value="<?= htmlspecialchars($utilisateur['pays']) ?>"/></p>
                <br>
                
                <p><label for="age" class="col-lg-2">Age :</label>
                <input type="text" name="age" id="age" value="<?= htmlspecialchars($utilisateur['age']) ?>"/></p>
                <br>
                
                <p><label for="genre" class="col-lg-2">Genre :</label>
                <INPUT type="radio" name="genre" value="m" <?php if ($utilisateur['genre'] == 'm') echo 'checked' ?> > Homme 
                <INPUT type="radio" name="genre" value="f" <?php if ($utilisateur['genre'] == 'f') echo 'checked' ?> > Femme </p>
                <br>

                <p><label for="mail" class="col-lg-2">Adresse e-mail :</label>
                <input type="text" name="mail" id="mail" value="<?= htmlspecialchars($utilisateur['mail']) ?>"/></p>
                <br>
                
                <p><label for="telephone" class="col-lg-2">Téléphone :</label>
                <input type="text" name="telephone" id="telephone" value="<?= htmlspecialchars($utilisateur['telephone']) ?>"/></p>
                <br><br>
                <em>Changer Mot de Passe (laisser vide si vous ne voulez pas le changer) :</em><br /><br />
                <p><label for="ancienMdp" class="col-lg-4">Ancien Mot de Passe :</label>
                <input type="password" name="ancienMdp" id="ancienMdp" /></p>
                <br />
                
                <p><label for="nouveauMdp" class="col-lg-4">Nouveau Mot de Passe :</label>
                <input type="password" name="nouveauMdp" id="nouveauMDP" /></p>
                <br />
                
              
                <p><label for="confMdp" class="col-lg-4">Confirmer nouveau Mot de Passe :</label>
                <input type="password" name="confMdp" id="confMdp" /></p>
                <br><br>
                <input type="hidden" name="infos" />
                <input class="btn btn-lg btn-success bouton" type="submit" value="Modifier mes informations">
                
            </form>
            <br /><br />
            
            <form method="post" action="?p=gestionProfil">
            <legend>Ajouter Voitures</legend>
        
                <p><label for="couleur" class="col-lg-3">Couleur :</label>
                <input type="text" name="couleur" id="couleur" /></p>
                <br>
                
                <p><label for="marque" class="col-lg-3">Marque :</label>
                <input type="text" name="marque" id="marque" /></p>
                <br>
                
                <p><label for="nbPlace" class="col-lg-3">Nombre de places :</label>
                <input type="text" name="nbPlace" id="nbPlace" /></p>
                <br>
                
                <p><label for="annee" class="col-lg-3">Année :</label>
                <input type="text" name="annee" id="annee" /></p>
                <br>
                
                <input type="hidden" name="voiture"/>
                <input class="btn btn-lg btn-success bouton" type="submit" value="Ajouter voiture">
                
            </form>
            
              
              
          </ul>
          </div>                 
        </div>
      </div>

