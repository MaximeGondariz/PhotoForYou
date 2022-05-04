
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <?php
    include('login.php');
    $donnees = $base->prepare('SELECT nbphotos FROM clients WHERE IdClient = '.$_SESSION['id']);
    $donnees->execute();
	  foreach($donnees as $nbphoto){
      echo '';
    }
  ?>
	<div class="container text-center" style="margin-top : 100px;">
    <div class="jumbotron">
      <h1 class="display-4">
        Page du Client <?= $_SESSION['nom'].' '.$_SESSION['prenom']; ?>
      </h1>
      <hr class="my-4">
      <h3 class="display-6">
        Ce client possèdent <?= $nbphoto['nbphotos']; ?> photos acheté.</br>
      </h3>
    </div>
    <?php
    ?>
	</div>

  <div class="row mt-5 justify-content-center">
    <?php 
      $donnees = $base->prepare('SELECT * FROM photo_achete WHERE id_client = '.$_SESSION['id']);
      $donnees->execute();
	    foreach($donnees as $photos){ ?>
      <div class="col-3 mt-4 text-center" style="min-width : 460px">
      <div class="card border-dark">
        <img class="card-img-top rounded mx-auto d-block mt-2" src="<?= '../images/Clients/'.$photos['id_client'].'/'.$photos['libelle']?>" alt="paysages" style="width:400px; height:350px;"/>
          <div class="card-body text-dark">
            <h2 class="card-title"><?= $photos['libelle'] ?></h2>
            <h4> Taille = <?= $photos['pixels_X'] ?>x<?= $photos['pixels_Y'] ?> </br>
            Poids = <?= $photos['poids'] ?>Mb</h4>
            <a class="btn btn-outline-success mt-1" href="<?='../images/Clients/'.$photos['id_client'].'/'.$photos['libelle']?>" download="<?= $photos['libelle'] ?>" role="button">Télécharger la photo</a></br>
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