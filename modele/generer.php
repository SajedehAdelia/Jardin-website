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
								<li class="scroll-to-section"><a href="index.php" class="active">Acceuil</a></li>
								<li class="scroll-to-section"><a href="iimg/nav/Modele_EA.jpg" target="_blank">Diagramme E/A</a></li>
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
		<!-- breadcrumb-section -->
		<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<div class="mt-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div align="center">
<?php 
$message = "";
function randPlante($connexion){
	$requete = "SELECT nom_pl FROM Plantes ORDER BY RAND() LIMIT 2";
	$res = mysqli_query($connexion,$requete); //execute la requete 
	if ($res !=FALSE){
		$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $row;
	}
	return -1;
}
function randVariété($connexion){
	$requete = "SELECT nom_var FROM Variété ORDER BY RAND() LIMIT 2";
	$res = mysqli_query($connexion,$requete); //execute la requete 
	if ($res !=FALSE){
		$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $row;
	}
	return -1;
}
function connectBD()
{
	$serveur = "localhost:3306";
	$user = "p1926543";
	$mdp = "Image77Affirm";
	$bd = "p1926543";
	$connexion = mysqli_connect($serveur, $user, $mdp, $bd);
	if (mysqli_connect_errno()) {
		printf("Échec de la connexion : %s\n", mysqli_connect_error());
		exit();
	}
	return $connexion;
}
$connexion = connectBD(); 

$plantes = randPlante($connexion);
$varietes = randVariété($connexion);
$v = 1;
$p = 1;


if(isset($_POST['GenererPar'])) { // formulaire soumis
  if ($_POST['min']>0 || $_POST['max']>$_POST['min']){/* test des valeurs rentrées dans le formulaire (test si min>0 et max>min) */
    $nbr = rand(($_POST['min']),($_POST['max'])); // choisie un nb entre min et max
	$nbvar = $nbr * ($_POST['%cul']) /100; // calcule le nb de rang cultivé
	$nbpl = $nbr * ($_POST['%mp']) /100; // calcule le nb de rang avec mauvaise plantes
	
	if(fmod($nbvar, 1) !== 0.00){
    // si la valeur est un decimal
	$nbvar = floor($nbvar); // arrondir à l'entier inferieur 
	}
	if(fmod($nbpl, 1) !== 0.00){
    // si la valeur est un decimal
	$nbpl = floor($nbpl); // arrondir à l'entier inferieur  
	}
	$j = $nbvar + 1;
	$nbVide = $nbr - $nbvar - $nbpl;}
    else{
         echo "Erreur dans la saisie des données du formulaire";
    }

}
  
?>
</div>
<h2>Génerer une parcelle</h2></br>

<form name="GenererPar" method="post" action="#">
        <h4>Nombre de rangs minimum et maximum sur la parcelle :</h4>
        min : <input type="number" id="min" name="min" min="1">  
		max : <input type="number" id="max" name="max" min="1" >
		<br>
		<h4>Portion occupée par des cultures :</h4>    <input type="number" id="%cul" name="%cul" min="0" max="100"> %</br>
		<h4>Portion occupée par des mauvaises plantes :</h4>    <input type="number" id="%mp" name="%mp" min="0" max="100"> %</br></br>
		<input type="submit" name="GenererPar" value="Generer" /></br>
</form>

<?php
    if(isset($_POST['GenererPar'])) {
		echo "<br>";
		echo "Nous avons donc une parcelle de $nbr rang, qui sera constituée de $nbvar rang(s) cultivé(s), $nbpl rang(s) avec mauvaise(s) plante(s) et de $nbVide rang(s) vide(s).";
        ?><h2>La parcelle générée :</h2><?php
		while($v <= $nbVide){
			?>
			<table>
			<h3><?php echo "Rang cultivé $nbvar : ";?></h3>
			<ul>
			<?php foreach($varietes as $variete) { ?>
			<li><?= $variete['nom_var'] ?></li>
			<?php }
			$varietes = randVariété($connexion);
			$v++;
			?>
			</ul></table>
        <?php }  
		while($p <= $nbpl){
			?><table>
			<h3> <?php echo "Rang avec plantes indesirables $j : ";?></h3>
			<ul>
			<?php foreach($plantes as $plante) { ?>
			<li><?= $plante['nom_pl'] ?></li>
			<?php }
			$plantes = randPlante($connexion);
			$p++;
			$j++;
			?>
			</ul></table>
        <?php }
	 } ?>


<?php if(isset($message)) { ?>
	<p style="background-color: yellow;"><?= $message ?></p>
<?php } ?>
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