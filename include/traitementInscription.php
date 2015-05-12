
<?

include 'C:/wamp/www/Projet Covoiturage/coVoiturage/connect.php';
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

$query= "INSERT INTO CompteUtilisateur (nomU, prenomU, adresse, age, genre, ville, pays, cp, mail, telephone, mdp) VALUES ('$nom', '$prenom', '$adresse', '$age', '$genre', '$ville', '$pays', '$cp', '$mail', '$telephone', '$inscriptionMdp')";
mysqli_query($conn, $query) or die ("echec de la requete inscription");

mysqli_close($conn);

?>