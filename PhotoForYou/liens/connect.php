<?php
require('login.php');

$emailuser = $_POST['emailuser'];
$p = 0;

$donnees = $base->prepare('SELECT IdUsers, EmailUsers, mdpUsers FROM users WHERE EmailUsers = :email');
$resultat = array();
$donnees->execute(array(':email'=>$emailuser));
foreach($donnees as $resultat){
	echo '';
}
if(!$resultat){
	echo '';
}
else{
	$CorrectPassword = password_verify($_POST['userpw'], $resultat['mdpUsers']);
}
if(!$resultat)
{
	$p = 3;
}

else
{
	if($CorrectPassword)
	{
		$p = 1;
		session_start();
	$donnees = $base->prepare('SELECT * FROM Users WHERE IdUsers = '.$resultat['IdUsers']);
	$donnees->execute();
    foreach($donnees as $user){
		$_SESSION['id'] = $user['IdUsers'];
		$_SESSION['nom'] = $user['NomUsers'];
		$_SESSION['prenom'] = $user['PrenomUsers'];
		$_SESSION['email'] = $user['EmailUsers'];
		$_SESSION['credit'] = $user['Credit'];
		if($user['TypeUsers'] == 'P'){
			$_SESSION['type']='photographe';
		}
		else{
			if($user['TypeUsers'] == 'C'){
				$_SESSION['type']='client';
			}
			else{
				$_SESSION['type']='admin';
			}
		}
    }
	}

	else
	{
		$p = 2;
	}
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
      	<?php
      	if($p == 1){
      		echo 'Connexion réussis';
      	}
      	else{
      		echo 'Connexion échouer';
      	}
      	?>
      </h1>
      <hr class="my-4">
      <p>
      	<?php
      	if($p == 1){
			echo 'Bon retour parmis nous '.$_SESSION['nom'].' '.$_SESSION['prenom'].'.</br>';
			echo 'Votre nombre de crédit s\'élève à '.$_SESSION['credit'];
      	}
      	else{
      		if($p == 2){
      			echo 'Le mot de passe est incorrect';
      		}
      		else{
      			echo 'L\'adresse mail n\'éxiste pas';
      		}
      	}
      	?>
      </p>
    </div>
	<?php
		include('footer.php');
	?>
</body>