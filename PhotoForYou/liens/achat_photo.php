<?php
    require('login.php');

    session_start();
    $photo = array();
    $client = array();
    $photographe = array();
    $donnees = $base->prepare('SELECT * FROM photos WHERE id_photos = '.$_POST['id']);
    $donnees->execute();
    foreach($donnees as $element){
        array_push($photo,$element);
    }

    $donnees = $base->prepare('SELECT * FROM Users WHERE IdUsers = '.$_SESSION['id']);
    $donnees->execute();
    foreach($donnees as $element){
        array_push($client,$element);
    }

    $donnees = $base->prepare('SELECT * FROM Users WHERE IdUsers = '.$photo[0]['id_photographe']);
    $donnees->execute();
    foreach($donnees as $element){
        array_push($photographe,$element);
    }

    $path_P = '../images/Photographes/'.$photo[0]['id_photographe'].'/'.basename($photo[0]['libelle']);
    $path_C = '../images/Clients/'.$_SESSION['id'].'/'.basename($photo[0]['libelle']);
    $i = $client[0]['Credit']-$photo[0]['prix'];
    $j = $photographe[0]['Credit']+$photo[0]['prix'];
    $n = 0;
    if($i >= 0){
        $achat = $base->prepare('UPDATE Users SET Credit = :Achat WHERE IdUsers = :id');
        $achat->execute(array(':Achat'=>$i, ':id'=>$_SESSION['id']));

        $vente = $base->prepare('UPDATE Users SET Credit = :Achat WHERE IdUsers = :id');
        $vente->execute(array(':Achat'=>$j, ':id'=>$photo[0]['id_photographe']));

        $appropriation = $base->prepare('INSERT INTO photo_achete(id_client,libelle,pixels_X,pixels_Y,poids) VALUES (:id,:lib,:X,:Y,:Po)');
        $appropriation->execute(array(':id'=>$_SESSION['id'],':lib'=>$photo[0]['libelle'],':X'=>$photo[0]['pixels_X'],':Y'=>$photo[0]['pixels_Y'],':Po'=>$photo[0]['poids']));

        $text = 'La photo à été acheté !!';
    }
    else{
        $text = 'Vous n\'avez pas assez de crédit pour acheter cette photo';
        $n = 1;
    }
?>


<?php
    include('header.php');
?>
    <div class="container mt-5" style="margin-top:100px">
        <div class="jumbotron">
            <h1 class="display-4">
                <?php 
                    if($n == 1){ ?>
                        <h1 class="display-4">
                            <?= $text ?>
			            </h1>
			            <hr class="my-4">
     		            <h3 class="display-6">
				            Allez en acheter dans la section <a href='../index.php?page=tarif_credit'>des Tarifs</a>
			            </h3>
                    <?php }
                    else {
                        copy($path_P, $path_C); ?>
                        <h1 class="display-4">
                            <?= $text ?>
			            </h1>
			            <hr class="my-4">
     		            <h3 class="display-6">
				            Vous pourrez la retrouver dans votre <a href='../index.php?page=personnel_C'>page personnel</a>
			            </h3>
                    <?php }
                ?>
			</h1>
		</div>
	</div>



<?php
    include('footer.php');
?>