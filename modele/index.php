<?php

//Sajedeh Adelia Fathipour, p2010153
//Sofia Lopez , p1926543
// index.php fait office de controleur frontal
session_start(); // démarre ou reprend une session
ini_set('display_errors', 1); // affiche les erreurs (au cas où)
ini_set('display_startup_errors', 1); // affiche les erreurs (au cas où)
error_reporting(E_ALL); // affiche les erreurs (au cas où)
if(file_exists('../private/config-bd.php'))  // vous n'avez pas besoin des lignes 7 à 9
require('../private/config-bd.php'); // inclut un fichier de config "privé"
else
require('inc/config-bd.php'); // vous pouvez inclure directement ce fichier de config (sans le if ... else précédent)
require('modele/modele.php'); // inclut le fichier modele
require('inc/includes.php'); // inclut des constantes et fonctions du site (nom, slogan)
require('inc/routes.php'); // fichiers de routes

$connexion = connectBD(); // connexion à la BD
?>
<!DOCTYPE html>
<html lang="en">
	
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	

	<!-- title -->
	<title>Jardin</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>
<body>
	
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">

						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img src="assets/img/greenhouse - secret garden.jpg" alt="">
							</a>
						</div>
						<!-- logo -->
						

						<!-- menu start -->
						<div align="center"></div>
						<nav class="main-menu">
							<ul>
								<li class="scroll-to-section"><a href="index.php" class="active">Accueil</a></li>
								<li class="scroll-to-section"><a href="img/nav/Modele_EA.jpg" target="_blank">Diagramme E/A</a></li>
								<li class="scroll-to-section"><a href="img/nav/Schéma_rel.txt" target="_blank">Schéma relationnel</a></li>
								<li class="scroll-to-section"><a href="img/nav/script.sql" target="_blank">Script SQL</a></li>
								<li class="scroll-to-section"><a href="img/nav/display_edite.php" target="_blank">....</a></li>
								
								
						     </ul>
						</nav>
						</div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle"></p>
							<h1>Jardin</h1>
							<div class="hero-btns">
								<a href="delete.php?page=fonctionnalite" class="bordered-btn">Suprimmer une Variete</a>
							</div>
							<div class="hero-btns">
								<a href="generer.php?page=generer" class="bordered-btn">Génerer une parcelle</a>
							</div>
							<div class="hero-btns">
								<a href="cart.php?page=ajouter" class="bordered-btn">Ajouter une variété</a>
							</div>
							<div class="hero-btns">
								<a href="index.php?page=afficher" class="bordered-btn">Afficher les variétés</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->
    <!-- php informations and commandes-->
    
    <div id="divCentral">
		
		
		<main>
		<?php
		$controleur = 'controleurAccueil'; // par défaut, on charge accueil.php
		$vue = 'vueAccueil'; // par défaut, on charge accueil.php
		if(isset($_GET['page'])) {
			$nomPage = $_GET['page'];
			if(isset($routes[$nomPage])) { // si la page existe dans le tableau des routes, on la charge
				$controleur = $routes[$nomPage]['controleur'];
				$vue = $routes[$nomPage]['vue'];
			}
		}
		include('controleurs/' . $controleur . '.php');
		include('vues/' . $vue . '.php');
		?>

		</main>
	</div>
  
</body>

<!-- footer -->
<footer>
<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Contact</h2>
						<ul>
							<li>43 Bd , 69100 Villeurbanne,France</li>
							<li>support@Jardin.com</li>
							<li>Phone: +33 71485736</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
						<a href="https://creativecommons.org/licenses/" target="_blank"><img src="img/by-nc-sa-eu.png" alt="Licence CC BY-NC-SA"/></a>
						<span><a href="http://liris.cnrs.fr/~fduchate/BDW1/" target="_blank" alt="Page BDW1">BDW1 - Base de données et programmation web</a> - UCB Lyon 1</span>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</footer>
	<!-- end footer -->
	

	
	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>
</html>
</html>
