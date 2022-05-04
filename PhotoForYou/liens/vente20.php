<?php
	$verif = $base->prepare('SELECT credit FROM Users WHERE IdUsers = :id');
	$verif->execute(array(':id'=>$_SESSION['id']));
	foreach($verif as $element){
		if($element['credit']-200 < 0){
			$text = 'Vous n\'avez pas assez de credit !!';
			$text2 = 'Veillez attendre d\'en recevoir plus.';
		}
		else{
			$donnees = $base->prepare('UPDATE Users SET Credit = Credit-200 WHERE IdUsers = :id');
    		$donnees->execute(array(':id'=>$_SESSION['id']));
			$text = 'Vous avez vendu 200 crédit !!';
			$text2 = 'Profité bien de vos 20€.';
		}
	}
?>

<div class="container mt-5">
    <div class="jumbotron">
      	<h1 class="display-4">
			<?= $text ?>
		</h1>
		<hr class="my-4">
     	<h3 class="display-6">
		 <?= $text2 ?>
		</h3>
	</div>
</div>
<?php
    include('footer.php');
?>