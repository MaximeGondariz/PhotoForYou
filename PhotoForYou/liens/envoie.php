<?php
require('login.php');

$nom = $_POST['nom'];

$prenom = $_POST['prenom'];

$email = $_POST['email'];

$type = $_POST['choixType'];

$mdp = password_hash($_POST['motdepasse1'], PASSWORD_DEFAULT);

	$insertion = $base->prepare('INSERT INTO users (NomUsers,PrenomUsers,EmailUsers,mdpUsers,TypeUsers,Credit) VALUES (:nom,:prenom,:email,:mdp,:type_user,:credit)');
	$insertion->execute(array(':nom'=>$nom,':prenom'=>$prenom,':email'=>$email,':mdp'=>$mdp,':type_user'=>$type,':credit'=>0));

	$id = $base->lastInsertId();

	if ($type == "P") {
		$text = 'Bienvenue futur Photographe !!';
		mkdir("../images/Photographes/".$id, 0777);
	}

	else {
		$text = 'Bienvenue futur Client !!';
		mkdir("../images/Clients/".$id, 0777);
	} 
?>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <?php
    include ("header.php");
  ?>

	<div class="container" style="margin-top:100px">
    	<div class="jumbotron">
      		<h1 class="display-4">
				Vous avez été enregistré dans notre base de données
			</h1>
			<hr class="my-4">
     		<h3 class="display-6">
				<?= $text ?>
			</h3>
		</div>
	</div>
	<?php
		include('footer.php');
	?>
</body>