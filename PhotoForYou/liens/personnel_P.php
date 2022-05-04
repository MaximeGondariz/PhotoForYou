
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <?php
    include('login.php');
    $donnees = $base->prepare('SELECT nbphotos FROM photographes WHERE IdPhotographe = '.$_SESSION['id']);
    $donnees->execute();
	  foreach($donnees as $nbphoto){
      echo '';
    }
  ?>
	<div class="container text-center" style="margin-top : 100px;">
    <div class="jumbotron">
      <h1 class="display-4">
        Page du photographe <?= $_SESSION['nom'].' '.$_SESSION['prenom']; ?>
      </h1>
      <hr class="my-4">
      <h3 class="display-6">
        Ce photographe possèdent <?= $nbphoto['nbphotos']; ?> photos disponibles.</br>
        <a class="btn btn-secondary" style="margin-top:10px" href="index.php?page=ajout_photo" role="button">Mettez en vente une image</a>
      </h3>
    </div>
    <?php
    ?>
	</div>

  <div class="row mt-5 justify-content-center">
    <?php 
      $donnees = $base->prepare('SELECT * FROM photos WHERE id_photographe = '.$_SESSION['id']);
      $donnees->execute();
	    foreach($donnees as $photos){ ?>
      <div class="col-3 mt-4 text-center" style="min-width : 460px">
      <?php
        if($photos['validation'] == 'oui'){
          echo '<div class="card border-success">';
        }
        else{
          if($photos['validation'] == 'en_cours'){
            echo '<div class="card border-warning">';
          }
          else{
            echo '<div class="card border-danger">';
          }
        }
      ?>
      <div class="card border-dark">
        <img class="card-img-top rounded mx-auto d-block mt-2" src="<?= '../images/Photographes/'.$photos['id_photographe'].'/'.$photos['libelle']?>" alt="paysages" style="width:400px; height:350px;"/>
          <div class="card-body text-dark">
            <h2 class="card-title"><?= $photos['libelle'] ?></h2>
            <h3> Prix = <?= $photos['prix'] ?> crédits</h3>
            <h4> Taille = <?= $photos['pixels_X'] ?>x<?= $photos['pixels_Y'] ?> </br>
            Poids = <?= $photos['poids'] ?>Mb</h4>
            <form method="post" action="#">
              <input type="hidden" value="<?= $photos['id_photos'] ?>" name="id" id="id">
              <button class="btn btn-outline-success" style="margin-top:10px" type="submit">Modifier la photo</button></br>
            </form>
            <form method="post" action="liens/delete_image.php">
              <input type="hidden" value="<?= $photos['id_photos'] ?>" name="id" id="id">
              <button class="btn btn-outline-success" style="margin-top:10px" type="submit">Supprimer la photo</button></br>
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