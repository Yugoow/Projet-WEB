<!DOCTYPE html>

<html lang="fr" style="height:100%">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>LESITE Connexion</title>

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


	<main>

		<!--Partie connexion-->
		<h5>Se connecter à mon espace</h5>
		<section id="sect_conn">

			<form>
				<div class="form-group">
					<label for="input_id">Identifiant</label>
					<input type="email" class="form-control" id="input_id" aria-describedby="emailHelp">
					<small id="emailHelp" class="form-text text-muted">On ne partagera jamais vos identifiants avec qui que ce soit.</small>
				</div>
				<div class="form-group">
					<label for="input-pswd">Mot de passe</label>
					<input type="password" class="form-control" id="input-pswd">
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="conn_alive">
					<label class="form-check-label" for="conn_alive">Boutton rester connecter ?</label>
				</div>
				<button type="submit" class="btn btn-primary">Connexion</button>
				<button type="button" class="btn btn-outline-secondary float-right">Réinitialiser</button>
			</form>

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