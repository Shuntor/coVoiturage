

<?php
if (isset($_POST['valider']))
{

function checkAdrMail($mail)
{
	if(filter_var($mail, FILTER_VALIDATE_EMAIL))
	{
		return 1;
        
	}
    else
    {
        return 0;
    }
	
}

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
    
if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['age']) || empty($_POST['pays']) || empty($_POST['genre']) || empty($_POST['mail'])|| empty($_POST['telephone']) || empty($_POST['inscriptionMdp']) || empty($_POST['inscriptionConfMdp']))
	{
		
         
        echo " <div class=\"infoErreur col-lg-8\"> <p class=\"infoMessage\"><img src=\"icon/Error.ico\" />   ERREUR : Tous les champs n'ont pas été renseignés</p> </div>";
       
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
        
        
        if ( checkAdrMail($mail) === 1)
        {
            if (checkAge($age) === 1)
            {
                     if (checkTel($telephone) === 1)
                     {
                         if (verifMdp($inscriptionMdp, $inscriptionConfMdp) === 1)
                         {
                             if (verifIdLibre($mail, $conn) === 1)
                             {
                             $query= "INSERT INTO CompteUtilisateur (idU, nomU, prenomU, age, genre, pays, mail, telephone, mdp) VALUES ('$mail', '$nom', '$prenom', '$age', '$genre', '$pays', '$mail', '$telephone',  '$inscriptionMdp')";
        mysqli_query($conn, $query) or die (mysqli_error($conn));

        mysqli_close($conn);
                                  //header('Location: index.php');
                                  
           
            echo " <div class=\"infoSucces col-lg-8\"> <p class=\"infoMessage\"><img src=\"icon/success.ico\" />   SUCCES : Inscription réalisé avec succés !</p><a href='?p='>Retour à l'accueil</a> </div>";
            
                             }
                             else
                             {
                                 
                                 echo " <div class=\"infoErreur col-lg-8\"> <p class=\"infoMessage\"><img src=\"icon/Error.ico\" />   ERREUR : Adresse e-mail déjà utilisée</p> </div>";
                             }
                            
                         }
                         else
                         {
                             echo " <div class=\"infoErreur col-lg-8\"> <p class=\"infoMessage\"><img src=\"icon/Error.ico\" />   ERREUR : Mots de passe différents</p> </div>";
                             
                         }
                     }
                     else
                     {
                          echo " <div class=\"infoErreur col-lg-8\"> <p class=\"infoMessage\"><img src=\"icon/Error.ico\" />   ERREUR : Numéro de téléphone non valide</p> </div>";
                         
                     }
            }
            else 
            {
                echo " <div class=\"infoErreur col-lg-8\"> <p class=\"infoMessage\"><img src=\"icon/Error.ico\" />   ERREUR : Age non valide</p> </div>";
                
            }
        }
        else 
        {
            echo " <div class=\"infoErreur col-lg-8\"> <p class=\"infoMessage\"><img src=\"icon/Error.ico\" />   ERREUR : Adress e-mail non valide</p> </div>";
            
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

