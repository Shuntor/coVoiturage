<?php

// TODO : tests des valeurs + garder le zéro devant le CP

$query = "SELECT *
FROM CompteUtilisateur
WHERE idU = '".mysqli_real_escape_string($conn, $_SESSION['idU']) . "';";

$result = mysqli_query($conn,$query) or die (mysqli_error($conn));

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$utilisateur = $row;

$modifValides = TRUE;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (empty($_POST['prenom']))
    {
        echo "Prenom vide !<br/>";
        $modifValides = FALSE;
    }
    if (empty($_POST['nom']))
    {
        echo "Nom vide !<br/>";
        $modifValides = FALSE;
    }
    if (empty($_POST['adresse']))
    {
        echo "Adresse vide !<br/>";
        $modifValides = FALSE;
    }
    if (empty($_POST['ville']))
    {
        echo "Ville vide !<br/>";
        $modifValides = FALSE;
    }
    if (empty($_POST['cp']))
    {
        echo "Code postal vide !<br/>";
        $modifValides = FALSE;
    }
    if (empty($_POST['pays']))
    {
        echo "Payse vide !<br/>";
        $modifValides = FALSE;
    }
    if (empty($_POST['genre']))
    {
        echo "Genre vide !<br/>";
        $modifValides = FALSE;
    }
    if (empty($_POST['mail']))
    {
        echo "Mail vide !<br/>";
        $modifValides = FALSE;
    }
    if (empty($_POST['telephone']))
    {
        echo "Téléphone vide !<br/>";
        $modifValides = FALSE;
    }
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
        $query  = "UPDATE compteutilisateur SET ";
        $query .= "nomU='" . mysqli_real_escape_string($conn, $_POST['nom']) . "', ";
        $query .= "prenomU='" . mysqli_real_escape_string($conn, $_POST['prenom']) . "', ";
        $query .= "age='" . mysqli_real_escape_string($conn, $_POST['age']) . "', ";
        $query .= "genre='" . mysqli_real_escape_string($conn, $_POST['genre']) . "', ";
        $query .= "adresse='" . mysqli_real_escape_string($conn, $_POST['adresse']) . "', ";
        $query .= "ville='" . mysqli_real_escape_string($conn, $_POST['ville']) . "', ";
        $query .= "pays='" . mysqli_real_escape_string($conn, $_POST['pays']) . "', ";
        $query .= "cp='" . mysqli_real_escape_string($conn, $_POST['cp']) . "', ";
        $query .= "mail='" . mysqli_real_escape_string($conn, $_POST['mail']) . "', ";
        if (!empty($_POST['nouveauMdp']))
            $query .= "mdp='" . mysqli_real_escape_string($conn, $_POST['nouveauMdp']) . "', ";
        $query .= "telephone='" . mysqli_real_escape_string($conn, $_POST['telephone']) . "' ";
        $query .= "WHERE idU=" . $_SESSION['idU'] . ";";
        
        
        mysqli_query($conn,$query) or die (mysqli_error($conn));
        //print_r($result);
        echo "Modifications effectués !";
    }
    else
        echo "Aucune modification effectué !";
}
    
$query = "SELECT *
FROM CompteUtilisateur
WHERE idU = '".mysqli_real_escape_string($conn, $_SESSION['idU']) . "';";

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
            <form method="post" action="?p=gestionProfil" class="col-lg-8">
        
                <p><label for="nom" class="col-lg-3">Nom :</label>
                <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($utilisateur['nomU']) ?>"/></p>
                <br><br>
                
                <p><label for="prenom" class="col-lg-3">Prénom :</label>
                <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($utilisateur['prenomU']) ?>"/></p>
                <br><br>
                
                <p><label for="adresse" class="col-lg-3">Adresse :</label>
                <input type="text" name="adresse" id="adresse" value="<?= htmlspecialchars($utilisateur['adresse']) ?>"/></p>
                <br><br>
                
                <p><label for="ville" class="col-lg-3">Ville :</label>
                <input type="text" name="ville" id="ville" value="<?= htmlspecialchars($utilisateur['ville']) ?>"/></p>
                <br><br>
                
                <p><label for="cp" class="col-lg-3">Code postale :</label>
                <input type="text" name="cp" id="cp" value="<?= htmlspecialchars($utilisateur['cp']) ?>"/></p>
                <br><br>
                
                <p><label for="pays" class="col-lg-3">Pays :</label>
                <input type="text" name="pays" id="pays" value="<?= htmlspecialchars($utilisateur['pays']) ?>"/></p>
                <br><br>
                
                <p><label for="age" class="col-lg-3">Age :</label>
                <input type="text" name="age" id="age" value="<?= htmlspecialchars($utilisateur['age']) ?>"/></p>
                <br><br>
                
                <p><label for="genre" class="col-lg-3">Genre :</label>
                <input type="text" name="genre" id="genre" value="<?= htmlspecialchars($utilisateur['genre']) ?>"/></p>
                <br><br>
                
                <p><label for="mail" class="col-lg-3">Adresse e-mail :</label>
                <input type="text" name="mail" id="mail" value="<?= htmlspecialchars($utilisateur['mail']) ?>"/></p>
                <br><br>
                
                <p><label for="telephone" class="col-lg-3">Téléphone :</label>
                <input type="text" name="telephone" id="telephone" value="<?= htmlspecialchars($utilisateur['telephone']) ?>"/></p>
                <br><br>
                
                <em>Changer Mot de Passe (laisser vide si vous ne voulez pas le changer):</em>
                <p><label for="ancienMdp" class="col-lg-3">Ancien Mot de Passe :</label>
                <input type="password" name="ancienMdp" id="ancienMdp" /></p>
                <br />
                
                <p><label for="nouveauMdp" class="col-lg-3">Nouveau Mot de Passe :</label>
                <input type="password" name="nouveauMdp" id="nouveauMDP" /></p>
                <br />
                
              
                <p><label for="confMdp" class="col-lg-3">Confirmer nouveau Mot de Passe :</label>
                <input type="password" name="confMdp" id="confMdp" /></p>
                <br><br>
                
                <input type="submit" value="Modifier mes informations">
                
            </form>
            
              
              
          </ul>
          </div>                 
        </div>
      </div>

