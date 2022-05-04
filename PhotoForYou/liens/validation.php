<?php
require('login.php');

session_start();

include('fonction.php');
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
			</h1>
		</div>
	</div>
  <div class="row mt-5 justify-content-center">
    <?php 
        $donnees = $base->prepare('SELECT id_photos,id_photographe,libelle,pixels_X,pixels_Y,poids,prix FROM photos WHERE validation = "en_cours"');
        $donnees->execute();
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
            <hr class="my-4">
            <form method="POST" action="liens/exec_validation.php">
              <input type="hidden" value="<?= $photos['id_photos'] ?>" name="id" id="id">
              <input type="hidden" value="oui" name="valid" id="valid">
              <button class="btn btn-outline-success" style="margin-top:10px" type="submit">Validé cette photo</button></br>
            </form>
            <form method="POST" action="liens/exec_validation.php">
              <input type="hidden" value="<?= $photos['id_photos'] ?>" name="id" id="id">
              <input type="hidden" value="non" name="valid" id="valid">
              <button class="btn btn-outline-danger" style="margin-top:10px" type="submit">Désaprouver cette photo</button></br>
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