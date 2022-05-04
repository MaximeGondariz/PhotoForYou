<!doctype HTML>
<html lang="fr">
<head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script>
  (function() {
    "use strict"
    window.addEventListener("load", function() {
      var form = document.getElementById("form")
      form.addEventListener("submit", function(event) {
        if (form.checkValidity() == false) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add("was-validated")
      }, false)
    }, false)
  }())
  </script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <div class="container" style="margin-top : 100px;margin-bottom : 50px;">
    <div class="jumbotron">
      <h1 class="display-4">Connexion</h1>
      <hr class="my-4">
      <p>Remplisser les deux champs correctement et vous pourrez accédez à votre compte</p>
	  <p>Vous n'avez pas de compte? <a href="inscription.php">INSCRIVEZ-VOUS!</a></p>
    </div>
	<form id="form" action="liens/connect.php" method="POST" novalidate>
		<div class="form-group row">
        	<div class="col-md-4 mb-3">
          		<label for="emailuser">Email</label>
          		<input type="text" class="form-control" id="emailuser" name="emailuser" placeholder="Votre email" required>
          		<div class="invalid-feedback">
            		Le champ prénom est obligatoire
          		</div>
        	</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-4 mb-3">
          		<label for="userpw">Mot de passe</label>
          		<input type="password" class="form-control" id="userpw" name="userpw" placeholder="Votre mot de passe" required>
          		<div class="invalid-feedback">
           			Les mots de passe ne sont pas identiques
          		</div>
        	</div>
      	</div>
      	<button class="btn btn-primary" type="submit">Connexion</button>
	</form>
  <?php
		include('footer.php');
	?>
</body>