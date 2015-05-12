<?php
$_SESSION['idU'] = 0;

$query = "SELECT *
FROM CompteUtilisateur
WHERE idU = '" . mysqli_real_escape_string($mysqli, $_SESSION['idU']) . "';";

$result = mysqli_query($mysqli,$query) or die (mysqli_error($mysqli));

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$utilisateur = $row;
/*
echo '<pre>';
print_r($result);
print_r($utilisateur);
echo '</pre>';
*/
?>

      <div class="row marketing">
        <div class="col-lg-12">
          <div class="form-group annonce">
          <h6>Gerer Mon Profil...</h6>
          <ul >
            <form method="post" action="traitement.php" class="col-lg-8">
        
                <p><label for="nom" class="col-lg-3">Nom :</label>
                <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($utilisateur['nomU']) ?>"/></p>
                <br><br>
                
                <p><label for="prenom" class="col-lg-3">Prénom :</label>
                <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($utilisateur['prenomU']) ?>"/></p>
                <br><br>
                
                <p><label for="adresse" class="col-lg-3">Adresse :</label>
                <input type="text" name="adresse" id="adresse" value="<?= htmlspecialchars($utilisateur['adresse']) ?>"/></p>
                <br><br>
                
                <p><label for="adresse" class="col-lg-3">Code postale :</label>
                <input type="text" name="adresse" id="adresse" value="<?= htmlspecialchars($utilisateur['cp']) ?>"/></p>
                <br><br>
                
                <p><label for="pays" class="col-lg-3">Pays :</label>
                <input type="text" name="pays" id="pays" value="<?= htmlspecialchars($utilisateur['pays']) ?>"/></p>
                <br><br>
                
                <p><label for="dateNaissance" class="col-lg-3">Age :</label>
                <input type="text" name="dateNaissance" id="dateNaissance" value="<?= htmlspecialchars($utilisateur['age']) ?>"/></p>
                <br><br>
                
                <p><label for="genre" class="col-lg-3">Genre :</label>
                <input type="text" name="genre" id="genre" value="<?= htmlspecialchars($utilisateur['genre']) ?>"/></p>
                <br><br>
                
                <p><label for="mail" class="col-lg-3">Adresse e-mail :</label>
                <input type="text" name="mail" id="mail" value="<?= htmlspecialchars($utilisateur['mail']) ?>"/></p>
                <br><br>
                
                <p><label for="mail" class="col-lg-3">Téléphone :</label>
                <input type="text" name="mail" id="mail" value="<?= htmlspecialchars($utilisateur['telephone']) ?>"/></p>
                <br><br>
                
                <em>Changer Mot de Passe:</em>
                <p><label for="ancienMdp" class="col-lg-3">Ancien Mot de Passe :</label>
                <input type="password" name="ancienMdp" id="ancienMdp" value="<?= htmlspecialchars($utilisateur['mdp']) ?>"/></p>
                <p><label for="nouveauMdp" class="col-lg-3">Nouveau Mot de Passe :</label>
                <input type="password" name="nouveauMdp" id="nouveauMDP" /></p>
                <p><label for="confMdp" class="col-lg-3">Confirmer nouveau Mot de Passe :</label>
                <input type="password" name="confMdp" id="confMdp" /></p>
                <br><br>
                
                
                
            </form>
            
              
              
          </ul>
          </div>                 
        </div>
      </div>

