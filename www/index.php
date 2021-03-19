<!DOCTYPE html>

<html lang="fr">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>LESITE Projet WEB</title>

	<!--Scripts css-->
	<link rel="stylesheet" href="./assets/vendors/bootstrap/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="./assets/css/style.css">

</head>


<body class="container">

	<!--Entete de l'accueuil avec un hamburger et le bouton rechercher pour telephone-->
<?php
require 'header.html';
?>


	<!--Partie principale, avec les dernières nouveautés et la wish-list-->
	<main>

		<!--Nouveaux stages-->
		<section class="sect-div">
			<h5>Dernières offres de stage</h5>
			<div class="disp_offre">
				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage PARIS</h6>
					<p>Domaine : Informatique	Promotion : BAC+2	Dates :X/X/X - X/X/X</p>
					<p>Gestion d'une BDD reliéeà des API</p>

				</article>

				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage NANCY</h6>
					<p>Domaine : Informatique	Promotion : BAC+2	Dates :X/X/X - X/X/X</p>
					<p>Gestion d'une BDD reliéeà des API. BLALALALALALANB AABfBBSDHALZFIHAIFHZIELFGAGBZV</p>
				</article>

				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage METZ</h6>
					<p>Domaine : Informatique	Promotion : BAC+2	Dates :X/X/X - X/X/X</p>
					<p>Gestion d'une BDD reliéeà des API</p>
				</article>

				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage MARSEILLE</h6>
					<p>Domaine : Informatique	Promotion : BAC+2	Dates :X/X/X - X/X/X</p>
					<p>Gestion d'une BDD reliéeà des API</p>
				</article>

				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage STRASBOURG</h6>
					<p>Domaine : Informatique	Promotion : BAC+2	Dates :X/X/X - X/X/X</p>
					<p>Gestion d'une BDD reliéeà des API</p>
				</article>
			</div>

		</section>


		<!--La WISH-LIST-->
		<section class="sect-div">
			<hr class="phone" style="background:white">
			<h5>WISH-LIST <i class="far fa-bookmark float-right"></i></h5>
			<div id="wlist" class="disp_offre">
				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage NANCY</h6>
					<p>Domaine : Informatique	Promotion : BAC+2	Dates :X/X/X - X/X/X</p>
					<p>Gestion d'une BDD reliéeà des API</p>
				</article>

				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage REIMS</h6>
				</article>

				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage VERDUN</h6>
				</article>

				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage BREST</h6>
				</article>

				<article class="nvloffre" onclick="window.location.href = 'connexion.html';">
					<h6>Stage DIJON</h6>
				</article>
			</div>
		</section>


	<!--Bloc recherche, avec le form pour rechercher -->
<?php
require 'recherche.html';
?>


	</main>


	<!--Footer pour les copyright-->
	<footer class="d-flex justify-content-center m-1 p-1">
		<p>Copyright © 2021 Groupe HPL</p>
	</footer>

	<!--Scripts javascript-->
	<script src="./assets/vendors/jquery/jquery-3.5.1.min.js"></script>
	<script src="./assets/vendors/bootstrap/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>
	<script src="./assets/script.js"></script>


</body>

</html>