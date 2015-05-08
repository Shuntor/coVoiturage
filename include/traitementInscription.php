
<?

include 'connect.php';
if (isset($_POST['nomq']))
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
if (isset($_POST['sexe']))
{
          $sexe = $_POST ['sexe'];
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

mysqli_query($conn, "INSERT INTO compteutilisateur (nomU, prenomU, adresse, age, genre, ville, pays, cp, mail, telephone, mdp) VALUES ('$nom', '$prenom', '$adresse', '$age', '$sexe', '$ville', '$pays', '$cp', '$mail', '$telephone', '$inscriptionMdp')");

mysqli_close($conn);

?>