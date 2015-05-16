

<?
if (isset($_POST['valider']))
{

include 'C:/wamp/www/Projet Covoiturage/coVoiturage/connect.php';

function checkAdrMail($mail)
{
	if(strpos($mail, "@") === false)
	{
		echo "<h2>Adresse Mail invalide</h2>";
	}
	
}

function checkAge($age)
{
   if (is_int($age) === true || $age < 18 || $age > 115)
	{
		echo "<h2>Age non valide</h2>";
	}  
}

function checkCp($cp)
{
   if (is_int($cp) === true || $cp < 1000 || $cp > 96000)
	{
		echo "<h2>Code Postal non valide</h2>";
	}  
    
}

function checkTel($telephone)
{
   if (is_int($telephone) === true)
	{
		echo "<h2>Numéro de téléphone non valide</h2>";
	}  
    
}

function verifMdp($inscriptionMdp, $inscriptionConfMdp)
{
    if($inscriptionMdp == $inscriptionConfMdp)
{
    }
        else
        {
            echo "<h2>Mots de passes différents</h2>";
        }
    
}
    
if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['adresse']) || empty($_POST['age']) || empty($_POST['pays']) || empty($_POST['ville']) || empty($_POST['cp']) || empty($_POST['genre']) || empty($_POST['mail'])|| empty($_POST['telephone']) || empty($_POST['inscriptionMdp']) || empty($_POST['inscriptionConfMdp']))
	{
		echo "<h2>ERREUR : tous les champs n'ont pas été renseignés</h2>";
	}
    
    
    else {  
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
          checkAge($age);
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
          checkCp($cp);
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
          checkTel($telephone);
}
if (isset($_POST['inscriptionMdp']))
{
          $inscriptionMdp = $_POST ['inscriptionMdp'];
}

if (isset($_POST['inscriptionConfMdp']))
{
          $inscriptionConfMdp = $_POST ['inscriptionConfMdp'];
}

        verifMdp($inscriptionMdp, $inscriptionConfMdp);
            
$query= "INSERT INTO CompteUtilisateur (idU, nomU, prenomU, adresse, age, genre, ville, pays, cp, mail, telephone, mdp) VALUES ('$mail', '$nom', '$prenom', '$adresse', '$age', '$genre', '$ville', '$pays', '$cp', '$mail', '$telephone', '$inscriptionMdp')";
mysqli_query($conn, $query) or die (mysqli_error($conn));

mysqli_close($conn);
    }
}
?>



 <div class="row marketing">
        <div class="col-lg-12">
          <div class="form-group annonce">
          <h6>M'inscrire...</h6>
          <ul >
            <form method="post" action="" class="col-lg-8" onSubmit="valider_formulaire(this)">
        
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
                <INPUT type="radio" name="genre" value="1"> Homme 
                <INPUT type="radio" name="genre" value="2"> Femme </p>
                <br><br>
                
                 <p><label for="telephone" class="col-lg-3">Téléphone (ex:0102030405) :</label>
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

