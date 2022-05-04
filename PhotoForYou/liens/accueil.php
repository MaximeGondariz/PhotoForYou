<body>
	<div class="container text-center">

		<div class="py-5 text-center">
        <img class="d-block mx-auto mb-2" src="../images/logo.png" alt="" width="170" height="115">
        <h1 class="display-5">PhotoForYou</h1>
        <p class="lead">Des pros au service des professionnels de la communication.</p>
      	</div>
		</div>
		<!-- Carrousel -->
		<div id="row carouselExampleControls" class="carousel slide" data-ride="carousel" style="margin-bottom:50px">
	  		<div class="carousel-inner" style="width : 80%; margin : auto">
	    		<div class="carousel-item active">
	     			<img src="../images/carrousel/carrousel1.png" class="d-block w-100" alt="First Image">
	    		</div>
	    		<div class="carousel-item">
	      			<img src="../images/carrousel/carrousel2.png" class="d-block w-100" alt="Second Image">
	    		</div>
	    		<div class="carousel-item">
	      			<img src="../images/carrousel/carrousel3.png" class="d-block w-100" alt="Third Image">
	    		</div>
	  		</div>
	  		<!-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="color:black">
	    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    		<span class="sr-only">Previous</span>
	  		</a>
	  		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="color:black">
	    		<span class="carousel-control-next-icon" aria-hidden="true"></span> 
	    		<span class="sr-only">Next</span>
	  		</a> -->
		</div>
		<?php
		if(!isset($_SESSION['type'])){
		?>
		<div class="jumbotron ">
    		<p class="lead">Moins de temps à chercher. Plus de résultats.</p>
				<p class="lead">Découvrez les images qui vous aideront à vous démarquer.</p>
				<p><a class="btn btn-primary btn-lg" href="inscription.php" role="button">Inscrivez vous !</a></p>
		</div>
		<?php
		}
		?>

		<div class="row">
			<div class="col p-auto mt-5">
				<div class="card-deck" style="color: white;">
					<div class="card bg-warning border-dark">
						<img class="card-img-top" src="../images/paysages.jpg" alt="paysages"/>
						<div class="card-img-overlay">
						    <h5 class="card-title">Paysages</h5>
						</div>
						<div class="card-body">
							<h5 class="card-title">Les paysages</h5>
							<p class="card-text">Une collection de photos extraordinaires réalisées par des photographes professionnels. Redecouvrez la planète terre ! </p>
							<a href="#" class="btn btn-primary">Je veux voir...</a>
						</div>
						<div class="card-footer">
							<small>Dernière mise à jour 1 Septembre 2019</small>
						</div>
					</div>
					<div class="card bg-success border-dark">
						<img class="card-img-top" src="../images/portraits.jpg" alt="Elit Amet">
						<div class="card-img-overlay">
						    <h5 class="card-title">Portraits</h5>
						</div>
						<div class="card-body">
							<h5 class="card-title">Les portraits</h5>
							<p class="card-text">Toutes les expressions, tous les visages du sourire aux larmes. Vous trouverez le portrait qu'il vous faut pour vos publications.</p>
							<a href="#" class="btn btn-primary">Je veux voir...</a>
						</div>
						<div class="card-footer">
							<small>Dernière mise à jour 23 Aout 2019</small>
						</div>
					</div>
					<div class="card bg-danger border-dark">
						<img class="card-img-top" src="../images/evenements.jpg" alt="Sollicitudin Ornare Malesuada">
						<div class="card-img-overlay">
						    <h5 class="card-title">Evènements</h5>
						</div>
						<div class="card-body">
							<h5 class="card-title">Les évenements</h5>
							<p class="card-text">Que ce soit les mariages, férias, soirées DJ. Vous trouverez la photo pour mettre en valeur votre évènement.</p>
							<a href="www.google.fr" class="btn btn-primary">Je veux voir...</a>
						</div>
						<div class="card-footer">
							<small>Dernière mise à jour 20 Juillet 2019</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      		<h1 class="display-4">Tarifs</h1>
      		<p class="lead">Une tarification flexible.</p>
    	</div>
		<div class="card-deck mb-3 text-center">
			
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Essai</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mois</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>5 photos offertes</li>
              <li>Usage privé</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Faire un essai</button>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Formule Découverte</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">9 € <small class="text-muted">/ mois</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>20 crédits</li>
              <li>20 % de remise sur les photos</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Acheter</button>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Formule pro</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">19 € <small class="text-muted">/ mois</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>60 crédits</li>
              <li>30 % de remise sur les photos</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Acheter</button>
          </div>
        </div>
	</div>

	<?php
		include('footer.php');
	?>

<!-- Les liaisons aux scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>