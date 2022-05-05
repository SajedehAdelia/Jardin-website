<?php 
$message="Veuillez insérer une variété";


	$plantes = getInstances($connexion, $Plantes);
	$variete = getInstances($connexion, $Variété);
	

	
if(isset($_POST['add']))

{



$nom_var = mysqli_real_escape_string($connexion, $_POST['nom_var']);

$preco = mysqli_real_escape_string($connexion, $_POST['precocite']); // get back the information

$verification = getVariété($connexion, $nom_var, $preco);



if($verification == FALSE || count($verification) == 0) { // no series with this name , insert!

$annee_marche = mysqli_real_escape_string($connexion, $_POST['annee_marche']);

$entretien = mysqli_real_escape_string($connexion, $_POST['entretien']);

$recolte = mysqli_real_escape_string($connexion, $_POST['recolte']);

$nbj_levee = mysqli_real_escape_string($connexion, $_POST['nbj_levee']);

$comm_var = mysqli_real_escape_string($connexion, $_POST['comm_var']);

$desc_var = mysqli_real_escape_string($connexion, $_POST['desc_var']);

$plantation = mysqli_real_escape_string($connexion, $_POST['plantation']);

$insertion = IntegVariete($connexion, $nom_var, $annee_marche,$preco, $entretien, $recolte, $nbj_levee, $comm_var, $desc_var, $plantation);

if($insertion == TRUE) {

$message = "La variété $nom_var a bien été ajoutée !";

}

else {

$message = "Erreur lors de l'insertion de la variété $nom_var.";

}

}

else {

$message = "Une variété existe déjà avec ce nom ($nom_var).";

}

}

			
?>