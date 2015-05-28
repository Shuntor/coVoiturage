<?php if(isset($_POST['bp_valider'])) {
        ?>
        <div class="col-lg-12 alert alert-success">Message transmis !</div>
        <?php
}
?>
<div class="jumbotron formRecherche col-lg-12">
         <section>
         <h1>Contact</h1>
         <p class="lead">Nous sommes heureux de répondre à vos suggestions, remarques ou retours.</p>
            <form method="post" action="index.php?p=contact" onSubmit="return verif(this)">
                
                <p><label for="texte" class="col-lg-3">Votre email :</label>
		<input class="form-control col-lg-4" style="margin-bottom:20px" name="mail"></input></p>
        <br><br>
              
                <p><label for="texte" class="col-lg-3">Avis :</label>
		<TEXTAREA class="form-control col-lg-4" style="margin-bottom:20px" name="texte" rows=4 cols=40>J'aime beaucoup votre site !</TEXTAREA></p>
        <br><br>
		
		<!--bloc contenant le bouton valider-->
		<div>
			<input class="btn btn-lg btn-classique btn-success bouton" type='submit' value='Valider' name='bp_valider' />
		</div>
          </form>
        </section>
 </div>