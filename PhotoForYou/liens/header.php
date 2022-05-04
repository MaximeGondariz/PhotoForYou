<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="../index.php">PhotoForYou</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
				      <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" href="#">Photos</a>
				      <div class="dropdown-menu">
                <?php
                  if(!isset($_SESSION['type'])){
                    echo '<a class="dropdown-item" href="../index.php?page=inscription">Acheter</a>';
                    echo '<a class="dropdown-item" href="../index.php?page=inscription">Vendre</a>';
                  }
                  else {
                    if($_SESSION['type'] == 'client'){
                      echo '<a class="dropdown-item" href="recherche.php">Acheter</a>';
                    }
                    else {
                      echo '<a class="dropdown-item" href="../index.php?page=ajout_photo">Vendre</a>';
                    }
                  }
                ?>
					      <!-- <a class="dropdown-item" href="#">Les plus populaires</a>
					      <a class="dropdown-item" href="#">Les nouveautés</a> -->
						  </div>
					  </li>
            <li class="nav-item">
              <?php
                if(!isset($_SESSION['type'])){
                  echo '<a class="nav-link" href="../index.php?page=inscription">Tarifs</a>';
                }
                else{
                  if($_SESSION['type'] == 'client'){
                    echo '<a class="nav-link" href="../index.php?page=tarif_credit">Tarifs</a>';
                  }
                }
              ?>
            </li>
            <li class="nav-item">
            <?php
                if(isset($_SESSION['type'])){
                  $donnees = $base->prepare('SELECT credit FROM users WHERE IdUsers = :id');
                  $donnees->execute(array(':id'=>$_SESSION['id']));
                  foreach($donnees as $element){
                    $credit = $element[0];
                  }
                  if($_SESSION['type'] == 'client'){
                    echo '<a class="nav-link" href="../index.php?page=tarif_credit"> Vos Crédit : '.$credit.'</a>';
                  }
                  else{
                    echo '<a class="nav-link" href="../index.php?page=vente_credit"> Vos Crédit : '.$credit.'</a>';
                  }
                }
             ?>
             </li>
          </ul>
          <?php
            if(!isset($_SESSION['type'])){
              ?>
                <div class="form-inline mt-2 mt-md-0">
                  <input class="form-control mr-sm-2" type="text" placeholder="Rechercher..." aria-label="Search">
                  <a href="../index.php?page=inscription"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button></a>
                </div>
              <?php
            }
            if(@$_SESSION['type'] == 'client'){
              ?>
                <form class="form-inline mt-2 mt-md-0" action="recherche.php" method="GET">
                  <input class="form-control mr-sm-2" type="text" placeholder="Rechercher..." aria-label="Search" name="cat" id="cat">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
              <?php
            }
          ?>
          <ul class="navbar-nav mr-right">
            <li class="nav-item">
              <?php
                if(isset($_SESSION['type'])){
                  if($_SESSION['type'] == 'photographe'){
                    echo '<a class="nav-link btn btn-outline-dark" href="../index.php?page=personnel_P">Votre page</a>';
                  }
                  else{
                    echo '<a class="nav-link btn btn-outline-dark" href="../index.php?page=personnel_C">Votre page</a>';
                  }
                }
              ?>
            </li>
            <li class="nav-item">
              <?php
                if(isset($_SESSION['type'])){
              	  echo '<a class="nav-link btn btn-outline-dark" href="../index.php?page=deconnexion">deconnexion</a>';
                }
                else{
                  echo '<a class="nav-link btn btn-outline-dark" href="../index.php?page=connexion">se connecter</a>';
                }
              ?>
            </li>
            <li class="nav-item">
              <?php
                if(!isset($_SESSION['type'])){
                  echo '<a class="nav-link btn btn-outline-dark" href="../index.php?page=inscription">S\'identifier</a>';
                  }
              ?>
           	</li>
          </ul>  
        </div>
    	</nav>
  </header>