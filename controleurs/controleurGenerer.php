<?php 
require ('...modele/modele.php');
$message = "";
$plantes = randPlantes($connexion, $nbpl);
$varietes = randVariété($connexion, $nbvar);
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
