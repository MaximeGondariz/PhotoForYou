<!doctype html>
<?php
  session_start();
  if(!isset($_GET['page'])){
    $page = 'accueil';
  }
  else{
    $page = $_GET['page'];
  }
  include('liens/login.php');
?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="index.php">PhotoForYou</a>
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
                    echo '<a class="dropdown-item" href="index.php?page=inscription">Acheter</a>';
                    echo '<a class="dropdown-item" href="index.php?page=inscription">Vendre</a>';
                  }
                  else {
                    if($_SESSION['type'] == 'client'){
                      echo '<a class="dropdown-item" href="liens/recherche">Acheter</a>';
                    }
                    else {
                      echo '<a class="dropdown-item" href="index.php?page=ajout_photo">Vendre</a>';
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
                  echo '<a class="nav-link" href="index.php?page=inscription">Tarifs</a>';
                }
                else{
                  if($_SESSION['type'] == 'client'){
                    echo '<a class="nav-link" href="index.php?page=tarif_credit">Tarifs</a>';
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
                    echo '<a class="nav-link" href="index.php?page=tarif_credit"> Vos Crédit : '.$credit.'</a>';
                  }
                  else{
                    echo '<a class="nav-link" href="index.php?page=vente_credit"> Vos Crédit : '.$credit.'</a>';
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
                  <a href="index.php?page=inscription"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button></a>
                </div>
              <?php
            }
            if(@$_SESSION['type'] == 'client'){
              ?>
                <form class="form-inline mt-2 mt-md-0" action="liens/recherche.php" method="GET">
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
                    echo '<a class="nav-link btn btn-outline-dark" href="index.php?page=personnel_P">Votre page</a>';
                  }
                  else{
                    if($_SESSION['type'] == 'client'){
                    echo '<a class="nav-link btn btn-outline-dark" href="index.php?page=personnel_C">Votre page</a>';
                    }
                    else{
                      echo '<a class="nav-link btn btn-outline-dark" href="index.php?page=standby">gerer les comptes</a>';
                    }
                  }
                }
              ?>
            </li>
            <?php
              if(@$_SESSION['type'] == 'admin'){
                echo '<a class="nav-link btn btn-outline-dark" href="index.php?page=validation">validé des images</a>';
              }
            ?>
            <li class="nav-item">
              <?php
                if(isset($_SESSION['type'])){
              	  echo '<a class="nav-link btn btn-outline-dark" href="index.php?page=deconnexion">deconnexion</a>';
                }
                else{
                  echo '<a class="nav-link btn btn-outline-dark" href="index.php?page=connexion">se connecter</a>';
                }
              ?>
            </li>
            <li class="nav-item">
              <?php
                if(!isset($_SESSION['type'])){
                  echo '<a class="nav-link btn btn-outline-dark" href="index.php?page=inscription">S\'identifier</a>';
                  }
              ?>
           	</li>
          </ul>  
        </div>
    	</nav>
  </header>
  <?php
    switch($page){
      case $page == 'accueil':
        include('liens/accueil.php');
        break;
  
      case $page == 'inscription':
        include('liens/inscription.php');
        break;
      
      case $page == 'connexion':
        include('liens/connexion.php');
        break;
  
      case $page == 'deconnexion':
        include('liens/deconnexion.php');
        break;

      case $page == 'personnel_P':
        include('liens/personnel_P.php');
        break;

      case $page == 'personnel_C':
        include('liens/personnel_C.php');
        break;

      case $page == 'connect':
        include('liens/connect.php');
        break;
      
      case $page == 'envoie':
        include('liens/envoie.php');
        break;
      
      case $page == 'ajout_photo':
        include('liens/ajout_photo.php');
        break;

      case $page == 'tarif_credit':
        include('liens/tarif_credit.php');
        break;

      case $page == 'achat5':
        include('liens/achat5.php');
        break;

      case $page == 'achat10':
        include('liens/achat10.php');
        break;

      case $page == 'achat20':
        include('liens/achat20.php');
        break;

      case $page == 'vente_credit':
        include('liens/vente_credit.php');
        break;

      case $page == 'vente5':
        include('liens/vente5.php');
        break;

      case $page == 'vente10':
        include('liens/vente10.php');
        break;

      case $page == 'vente20':
        include('liens/vente20.php');
        break;

      case $page == 'standby':
        include('liens/standby.php');
        break;

      case $page == 'validation':
        include('liens/validation.php');
        break;
    }
  ?>
</body>