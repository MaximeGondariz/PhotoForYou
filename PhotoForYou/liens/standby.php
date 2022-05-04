<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <?php
    include('login.php');
  ?>
	<div class="container text-center" style="margin-top : 100px;">
    <div class="jumbotron">
      <h1 class="display-4">
        Voici tout les comptes non-admin de la base de données.
      </h1>
    </div>
    <?php
    ?>
	</div>

  <div class="row mt-5 justify-content-center">
    <?php 
      $donnees = $base->prepare('SELECT * FROM users WHERE TypeUsers != "A"');
      $donnees->execute();
	    foreach($donnees as $user){ ?>
      <div class="col-3 mt-4 text-center" style="min-width : 460px">
      <div class="card border-dark">
        <div class="card-body text-dark">
            <h2 class="card-title"><?= $user['NomUsers'].' '.$user['PrenomUsers'] ?></h2>
            <h3> Email = <?= $user['EmailUsers'] ?> crédits</h3>
            <h4> Type d'utilisateur = <?php 
                if($user['TypeUsers'] == 'P'){
                    echo 'Photographe';
                }
                else{
                    echo 'Client';
                }
            ?>
            <hr class="my-4">
            <form method="POST" action="liens/exec_standby.php">
              <input type="hidden" value="<?=$user['IdUsers']?>" name="id">
              <button class="btn btn-outline-success" style="margin-top:10px" type="submit">Changer le standby </button></br>
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