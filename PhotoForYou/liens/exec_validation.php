<?php
	session_start();
    require('login.php');

	$donnees = $base->prepare('UPDATE photos SET validation = :valid WHERE id_photos=:id');
	$donnees->execute(array(':id'=>$_POST['id'], ':valid'=>$_POST['valid']));
    if($_POST['valid'] == 'oui'){
        $text = 'Cette photo est maintenant validé';
    }
    else{
        $text = 'Cette photo est maintenant désaprouvé';
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
				<?= $text ?>
			</h1>
		</div>
	</div>
	<?php
		include('footer.php');
	?>
</body>