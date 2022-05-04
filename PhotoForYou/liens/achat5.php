<?php
    $donnees = $base->prepare('UPDATE Users SET Credit = Credit+50 WHERE IdUsers = :id');
    $donnees->execute(array(':id'=>$_SESSION['id']));
?>

<div class="container mt-5">
    <div class="jumbotron">
      	<h1 class="display-4">
			Vous avez acheté 50 crédit !!
		</h1>
		<hr class="my-4">
     	<h3 class="display-6">
			Les crédits sont déjà disponible sur votre compte.
		</h3>
	</div>
</div>
<?php
    include('footer.php');
?>