<?
if (isset($_POST['valider']))
{

include 'C:/wamp/www/Projet Covoiturage/coVoiturage/connect.php';

function checkAdrMail($mail)
{
	if(strpos($mail, "@") === false)
	{
		echo "<h2>Adresse invalide</h2>";
	}
	else
	{
		//echo "<h1>Adresse valide</h1>";
		list ($nom, $domaine)=explode("@",$mail);
		//echo "<p>nom: $nom</p>";
		//echo "<p>domaine: $domaine</p>";
	}
}

if (isset($_POST['nom']))
{
          $nom = $_POST ['nom'];
}
if (isset($_POST['prenom']))
{
          $prenom = $_POST ['prenom'];
}
if (isset($_POST['adresse']))
{
          $adresse = $_POST ['adresse'];
}
if (isset($_POST['age']))
{
          $age = $_POST ['age'];
}
if (isset($_POST['pays']))
{
          $pays = $_POST ['pays'];
}
if (isset($_POST['ville']))
{
          $ville = $_POST ['ville'];
          $ville = addslashes($ville);
}
if (isset($_POST['cp']))
{
          $cp = $_POST ['cp'];
}
if (isset($_POST['genre']))
{
          $genre = $_POST ['genre'];
}
if (isset($_POST['mail']))
{
          $mail = $_POST ['mail'];
          checkAdrMail($mail);
}
if (isset($_POST['telephone']))
{
          $telephone = $_POST ['telephone'];
}
if (isset($_POST['inscriptionMdp']))
{
          $inscriptionMdp = $_POST ['inscriptionMdp'];
}

if (isset($_POST['inscriptionConfMdp']))
{
          $inscriptionConfMdp = $_POST ['inscriptionConfMdp'];
}

$query= "INSERT INTO CompteUtilisateur (idU, nomU, prenomU, adresse, age, genre, ville, pays, cp, mail, telephone, mdp) VALUES ('$mail', '$nom', '$prenom', '$adresse', '$age', '$genre', '$ville', '$pays', '$cp', '$mail', '$telephone', '$inscriptionMdp')";
mysqli_query($conn, $query) or die (mysqli_error($conn));

mysqli_close($conn);
    
}
?>

 <div class="row marketing">
        <div class="col-lg-12">
          <div class="form-group annonce">
          <h6>M'inscrire...</h6>
          <ul >
            <form method="post" action="" class="col-lg-8">
        
                <p><label for="nom" class="col-lg-3">Nom :</label>
                <input type="text" name="nom" id="nom" /></p>
                <br><br>
                
                <p><label for="prenom" class="col-lg-3">Prénom :</label>
                <input type="text" name="prenom" id="prenom" /></p>
                <br><br>
                
                <p><label for="adresse" class="col-lg-3">Adresse :</label>
                <input type="text" name="adresse" id="adresse" /></p>
                <br><br>
                
                <p><label for="ville" class="col-lg-3">Ville :</label>
                <input type="text" name="ville" id="ville" /></p>
                <br><br>
                
                <p><label for="cp" class="col-lg-3">Code Postal :</label>
                <input type="text" name="cp" id="cp" /></p>
                <br><br>
                
                  <p><label for="pays" class="col-lg-3">Pays :</label>
                <input type="text" name="pays" id="pays" /></p>
                <br><br>
                
                <p><label for="age" class="col-lg-3">Age :</label>
                <input type="text" name="age" id="age" /></p>
                <br><br>
                
                <p><label for="genre" class="col-lg-3">Genre :</label>
                <input type="text" name="genre" id="genre" /></p>
                <br><br>
                
                 <p><label for="telephone" class="col-lg-3">Téléphone :</label>
                <input type="text" name="telephone" id="telephone" /></p>
                <br><br>
                
                <p><label for="mail" class="col-lg-3">Adresse e-mail :</label>
                <input type="text" name="mail" id="mail" /></p>
                <br><br>
                                
                <p><label for="inscriptionMdp" class="col-lg-3">Mot de Passe :</label>
                <input type="password" name="inscriptionMdp" id="inscriptionMDP" /></p>
                <p><label for="inscriptionConfMdp" class="col-lg-3">Confirmation du Mot de Passe :</label>
                <input type="password" name="inscriptionConfMdp" id="inscriptionConfMdp" /></p>
                <br><br>
                
                <input type="submit" value="Valider"  name="valider">
                
            </form>
            
              
              
          </ul>
          </div>                 
        </div>
      </div>
