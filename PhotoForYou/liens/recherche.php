<?php
require('login.php');

session_start();

include('fonction.php');

$cat = stripslashes(htmlentities(ucfirst(strtolower($_GET['cat'])), ENT_QUOTES, 'UTF-8'));
$cat = nospec($cat);
?>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <?php
    include ("header.php");
  ?>
  <div class="container mt-5" style="margin-top:100px">
    <div class="jumbotron">
      <h1 class="display-4">
        Voici les résultats de votre recherche.
        <?= $cat ?>
			</h1>
		</div>
	</div>
  <div class="row mt-5 justify-content-center">
    <?php 
      if($cat != ''){
        $donnees = $base->prepare('SELECT id_photos,id_photographe,P.libelle,pixels_X,pixels_Y,poids,prix FROM photos P,associe,categories C WHERE id_photos = id_pho AND id_cat = id_categorie AND C.libelle = :cat AND validation = "oui"');
      }
      else{
        $donnees = $base->prepare('SELECT * FROM photos WHERE validation = "oui"');
      }
      $donnees->execute(array(':cat'=>$cat));
	    foreach($donnees as $photos){ ?>
      <div class="col-3 mt-4 text-center" style="min-width : 460px">
      <div class="card border-dark">
        <img class="card-img-top rounded mx-auto d-block mt-2" src="<?= '../images/Photographes/'.$photos['id_photographe'].'/'.$photos['libelle']?>" alt="paysages" style="width:400px; height:350px;"/>
          <div class="card-body text-dark">
            <h2 class="card-title"><?= $photos['libelle'] ?></h2>
            <h3> Prix = <?= $photos['prix'] ?> crédits</h3>
            <h4> Taille = <?= $photos['pixels_X'] ?>x<?= $photos['pixels_Y'] ?> </br>
            Poids = <?= $photos['poids'] ?>Mb</h4>
            <p> Categories : 
            <?php
            $categories = $base->prepare('SELECT libelle FROM categories,associe WHERE id_categorie = id_cat AND id_pho = :id');
            $categories->execute(array(':id'=>$photos['id_photos']));
            foreach($categories as $element){
              echo $element[0].', ';
            }
            ?>
            </p>
            <form method="POST" action="achat_photo.php">
              <input type="hidden" value="<?= $photos['id_photos'] ?>" name="id" id="id">
              <button class="btn btn-outline-success" style="margin-top:10px" type="submit">Acheter la photo</button></br>
            </form>
          </div>
        </div>
      </div>
      <?php
      } 
    ?>
	</div>
  <?php
		include('footer.php');
	?>
</body>