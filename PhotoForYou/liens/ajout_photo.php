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
</head>
<body>
  <?php
    include('login.php');
  ?>
  
  
    <div class="container" style="margin-top:100px">
    	<div class="jumbotron">
      	<h1 class="display-4">
				Veillez choisir une image à mettre en vente
			  </h1>
		</div>
	</div>
  <div class="container" style="margin-top : 100px;margin-bottom : 50px;">
    <form method="post" enctype="multipart/form-data" action="liens/ajout.php" id="aj_photo">
      <div class="form-group row">
        <div class="col-md-4 mb-3">
          <label for="prenom">Photo</label></br>
          <input type="file" id="photo" name="photo" required>
          <div class="invalid-feedback">
            Une photo doit être récupérer !
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-4 mb-3">
          <label for="prenom">Catégorie</label></br>
          <input type="text" class="form-control" id="categories" name="categories[]" required>
          <div class="invalid-feedback">
            Une catégories est requis !
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-4 mb-3">
          <label for="prenom">Catégories supplémentaire (jusqu'à 9 catégories)</label></br>
          <div id="créer">
          
          </div>
        </div>
      </div>
      <input type="button" class="btn btn-danger" onclick="detruire(numid)" value="-"/>
      <input type="button" class="btn btn-success" onclick="creer(numid)" value="+"/>
      <div class="form-group row" style="margin-top:15px;">
        <div class="col-md-4 mb-3">
          <label for="nom">Prix</label>
          <input type="number" class="form-control" id="prix" name="prix" placeholder="Le prix" required>
          <div class="invalid-feedback">
            La photo doit avoir un prix !
          </div>
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Envoyer</button>
    </form>
    <script>
      var numid = 1;

      creer(numid);

      function creer(){
        if(numid < 10){
          Input = document.createElement('input'); //on crée l'élément (la balise) input
          Input.id = 'categories'+numid; //on définit l'attribut id du input
          Input.name = 'categories[]';
          Input.classList.add("form-control");
          Input.required = true;
          Input.style.marginTop = ".50cm";
          DIV = document.getElementById('créer'); //on récupère le noeud formulaire
          DIV.appendChild(Input);//on place le input dans le formulaire
          numid ++;
        }
        else{
          window.alerte('Vous ne pouvez pas mettre plus de 10 catégories')
        }
      }

      function detruire(){
        if(numid != 1){
          DIV = document.getElementById('créer'); //on récupère le noeud formulaire
          Input = document.getElementById('categories'+(numid-1)); //on récupère le noeud input
          DIV.removeChild(Input); //on retire le input
          numid --;
        }
      }
    </script>
  </div>
  <?php
		include('footer.php');
	?>
</body>