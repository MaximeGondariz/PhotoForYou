<?php
    include('login.php');
    session_start();
    $j = 0;
    $full_cat = $_POST['categories'];
    foreach($full_cat as $element){
        $full_cat[$j] = stripslashes(htmlentities(ucfirst(strtolower($element)), ENT_QUOTES, 'UTF-8'));

        $j++;
    }
    $j = 0;
    $error = 0;
    $libelle = $_FILES['photo']['name'];
    $path = '../images/Photographes/'.$_SESSION['id'].'/'.basename($libelle);
    $prix = $_POST['prix'];

    if(file_exists($path)){
        $text='L\'image est déjà en vente </br>';
        $error = 1;
    }
    else{
        move_uploaded_file($_FILES['photo']['tmp_name'], $path);
    
        $taille = getimagesize($path);
	    $largeur = $taille[0];
	    $hauteur = $taille[1];
        $extension = strtolower(strrchr($path, '.'));
        $poids = (round(((filesize($path)/1000000)*8),2));

        if($largeur < 240 || $hauteur < 160){
            $text='La taille de l\'image est invalide </br>';
            unlink($path);
            $error = 1;
        }
        else{
                if($poids > 30){
                    $text='Le poids de l\'image est invalide </br>';
                    unlink($path);
                    $error = 1;
                }
                else{
                    $text="L\'image est valide et disponible à l'achat";
            
                    $insertion = $base->prepare('INSERT INTO photos (id_photographe,libelle,pixels_X,pixels_Y,poids,prix) VALUES (:photographe,:lib,:pixX,:pixY,:poids,:prix)');
	                $insertion->execute(array(':photographe'=>$_SESSION['id'],':lib'=>$libelle,':pixX'=>$largeur,':pixY'=>$hauteur,':poids'=>$poids,':prix'=>$prix));
                    $id_pho = $base->lastInsertId();
                    foreach($full_cat as $cat){
                        $donnees = $base->prepare('SELECT libelle FROM categories');
                        $donnees->execute();
                        $id_all = $donnees->fetchALL();
                        foreach($id_all as $element){
                            if($cat == $element['libelle']){
                                $j++;
                            }
                        }
                        if($j == 0){
                            $insertion = $base->prepare('INSERT INTO categories (libelle) VALUES (:lib)');
                            $insertion->execute(array(':lib'=>$cat));
                            $id_cat = $base->lastInsertId();
                        }
                        else{
                            $donnees = $base->prepare('SELECT id_categorie FROM categories WHERE libelle = (:text)');
                            $donnees->execute(array(':text'=>$cat));
                            $id_all = $donnees->fetchALL();
                            $id_cat = $id_all[0]['id_categorie'];
                        }
                        $j = 0;

                        $insertion = $base->prepare('INSERT INTO associe VALUES (:id_pho,:id_cat)');
                        $insertion->execute(array(':id_pho'=>$id_pho, ':id_cat'=>$id_cat));
                    }
                }
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
                if($error == 1){
                    echo 'L\'image n\'à pas pu être envoyé';
                }
                else{
                    echo 'L\'image à pu être envoyé';
                }
              ?>
			</h1>
            <hr class="my-4">
     		<h3 class="display-6">
				<?php
                    if($error == 1){
                        echo $text;
                    }
                    else{
                        echo 'l\'image est maintenant disponible à la vente';
                    }
                ?>
			</h3>
		</div>
	</div>
    <?php
		include('footer.php');
	?>
</body>