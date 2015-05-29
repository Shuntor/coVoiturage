<?php
/*
    * Nom:inscription.php
    
    * Description: Page permettant à un utilisateur
                  de s'inscrire sur le Site internet 
                  afin d'avoir davantages de fonctionnalités
    
    * Pages appelées: --
*/


/*Si Bouton Valider Appuyé:*/
if (isset($_POST['valider']))
{

/*Définition de la fonction checkAdrMail($mail): fonction permettant de vérifier la validité de l'adresse Mail que l'utilisateur a entré*/
function checkAdrMail($mail)
{
	if(filter_var($mail, FILTER_VALIDATE_EMAIL)) /*Utilisation d'un pattern pour vérifier l'adresse e-mail*/
	{
		return 1;
        
	}
    else
    {
        return 0;
    }
	
}

/*Définition de la fonction checkAge($age): fonction permettant de vérifier la validité de l'age que l'utilisateur a entré*/
function checkAge($age)
{
   if (is_numeric($age))
	{
		return 1;
	}  
    else
    {
        return 0;   
    }
}

/*Définition de la fonction checkCp($cp): fonction permettant de vérifier la validité du code postale que l'utilisateur a entré*/
function checkCp($cp)
{
   if (is_numeric($cp) )
	{
		return 1;
	}  
    else
    {
        return 0;   
    } 
    
}

/*Définition de la fonction checkTel($telephone): fonction permettant de vérifier la validité du numéro de téléphone que l'utilisateur a entré*/
function checkTel($telephone)
{
   if (is_numeric($telephone))
	{
		return 1;
	}  
    else
    {
        return 0;   
    }   
    
}

/*Définition de la fonction verifMdp($inscriptionMdp, $inscriptionConfMdp): fonction permettant de vérifier la correspondance entre le mot de passe saisi et la confirmation de ce dernier*/
function verifMdp($inscriptionMdp, $inscriptionConfMdp)
{
    if($inscriptionMdp == $inscriptionConfMdp)
    {
		return 1;
	}  
    else
    {
        return 0;   
    } 
    
}

/*Définition de la fonction verifIdLibre($mail, $conn): fonction permettant de vérifier si l'adresse e-mail entrée n'est pas déja dans la base de données*/
function verifIdLibre($mail, $conn)
{
   $result = mysqli_query($conn, "SELECT idU FROM CompteUtilisateur WHERE idU='$mail'");
if(mysqli_num_rows($result)>=1)
    {
        return 0;
    }
    else
    {
        return 1;
    }
}

/*Condition permettant de vérifier que tous les champs de la page sont renseignés*/
if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['age']) || empty($_POST['pays']) || empty($_POST['genre']) || empty($_POST['mail'])|| empty($_POST['telephone']) || empty($_POST['inscriptionMdp']) || empty($_POST['inscriptionConfMdp']))
	{
		
         
        
        echo " <div class=\"alert alert-danger col-lg-12\" role=\"alert\">ERREUR : Tous les champs n'ont pas été renseignés!</div>";
	}
    
    
    else { /*On récupère les données*/
        
        if (isset($_POST['nom']))
        {
          $nom = $_POST ['nom'];
        }
        if (isset($_POST['prenom']))
        {
          $prenom = $_POST ['prenom'];
        }
        if (isset($_POST['age']))
        {
          $age = $_POST ['age'];
        }
        if (isset($_POST['pays']))
        {
          $pays = $_POST ['pays'];
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
        
        /*Appel de la fonction checkAdrMail($mail) permettant de vérifier si l'adresse e-mail est valide.*/
        if ( checkAdrMail($mail) === 1)
        {
            /*Appel de la fonction checkAge($age) permettant de vérifier si l'age est valide.*/
            if (checkAge($age) === 1)
            {
                     /*Appel de la fonction checkTel($telephone) permettant de vérifier si le numéro de téléphone est valide.*/
                     if (checkTel($telephone) === 1)
                     {
                         /*Appel de la fonction verifMdp($inscriptionMdp, $inscriptionConfMdp) permettant de vérifier si les deux champs mot de  
                         passe sont identiques*/
                         if (verifMdp($inscriptionMdp, $inscriptionConfMdp) === 1)
                         {
                             /*Appel de la fonction verifIdLibre($mail, $conn) permettant de vérifier dans la base de données si l'adresse e-mail n'est pas déjà enregistrée dans la base de données*/
                             if (verifIdLibre($mail, $conn) === 1)
                             {
                                 /*requête permettant d'insérer le nouvel utilisateur, une fois toutes les vérifictions faites*/
                                $query= "INSERT INTO CompteUtilisateur (idU, nomU, prenomU, age, genre, pays, mail, telephone, mdp) VALUES ('$mail', '$nom', '$prenom', '$age', '$genre', '$pays', '$mail', '$telephone',  '$inscriptionMdp')";
                                mysqli_query($conn, $query) or die (mysqli_error($conn));

                                mysqli_close($conn);
                                  
                                  
                                
                                echo " <div class=\"alert alert-success col-lg-12\" role=\"alert\">Nouvel utilisateur enregistré !</div>";
            
                             }
                             else
                             {
                                 
                                 echo " <div class=\"alert alert-danger col-lg-12\" role=\"alert\">ERREUR: Adresse e-mail déjà utilisée!</div>";
                             }
                            
                         }
                         else
                         {
                             
                             echo " <div class=\"alert alert-danger col-lg-12\" role=\"alert\">ERREUR : Mots de passe différents!</div>";
                         }
                     }
                     else
                     {
                          
                          echo " <div class=\"alert alert-danger col-lg-12\" role=\"alert\">ERREUR : Numéro de téléphone non valide!</div>";
                     }
            }
            else 
            {
                
                echo " <div class=\"alert alert-danger col-lg-12\" role=\"alert\">ERREUR : Age non valide!</div>";
            }
        }
        else 
        {
           
            echo " <div class=\"alert alert-danger col-lg-12\" role=\"alert\">ERREUR : Adress e-mail non valide!</div>";
        }
        
  
        
    }
}
?>



 <div class="row marketing col-lg-12">
          <div class="col-lg-12 form-group annonce">
          <h6>M'inscrire...</h6>
          <ul >
            <form method="post" action="" class="col-lg-8" onSubmit="valider_formulaire(this)">
        
                <p><label for="nom" class="col-lg-3">Nom :</label>
                <input type="text" name="nom" id="nom" /></p>
                <br>
                
                <p><label for="prenom" class="col-lg-3">Prénom :</label>
                <input type="text" name="prenom" id="prenom" /></p>
                <br>
                
                  <p><label for="pays" class="col-lg-3">Pays :</label>
                <input type="text" name="pays" id="pays" /></p>
                <br>
                
                <p><label for="age" class="col-lg-3">Age :</label>
                <input type="text" name="age" id="age" /></p>
                <br>
                
                <p><label for="genre" class="col-lg-3">Genre :</label>
                <INPUT type="radio" name="genre" value="m"> Homme 
                <INPUT type="radio" name="genre" value="f"> Femme </p>
                <br>
                
                 <p><label for="telephone" class="col-lg-3">Téléphone (ex:0102030405) :</label>
                <input type="text" name="telephone" id="telephone" /></p>
                <br>
                
                <p><label for="mail" class="col-lg-3">Adresse e-mail :</label>
                <input type="text" name="mail" id="mail" /></p>
                <br>
                                
                <p><label for="inscriptionMdp" class="col-lg-3">Mot de Passe :</label>
                <input type="password" name="inscriptionMdp" id="inscriptionMDP" /></p>
                <p><label for="inscriptionConfMdp" class="col-lg-3">Confirmation du Mot de Passe :</label>
                <input type="password" name="inscriptionConfMdp" id="inscriptionConfMdp" /></p>
                <br><br>
                
                <input class="btn btn-lg btn-success bouton" type="submit" value="Valider"  name="valider" >
                
                
                <!--<input type="submit" value="Valider"  name="valider" > -->
            </form>
            
              
              
          </ul>         
        </div>
      </div>

