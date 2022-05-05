<?php

// connexion à la BD, retourne un lien de connexion
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

// déconnexion de la BD
function deconnectBD($connexion)
{
	mysqli_close($connexion);
}

function insertPlantesFromDataset($connexion, $data)
{
	for ($i = 0; $i < 9; $i++) {
		$data[$i] = mysqli_real_escape_string($connexion, $data[$i]); // on transforme les data pour proteger les caractères spéciaux
	}
	$requete = "INSERT INTO Plantes (nom_pl, nom_Lat, Id_Typeplante, Id_Typeplante_1) VALUES ('$data[1]', '$data[2]', '$data[7]', '$data[8]')";
	$inser = mysqli_query($connexion, $requete); //envoi de la requête 
	if ($inser == FALSE) {
		return false;
	}
	return true;
}

//récupération des données fournies dans la BD dataset
function getEntitiesDataset($connexion)
{ // fonction qui prend toute les entités dans la dataset
	$requete = "SELECT * FROM dataset.DonneesFournies";
	$dataset = mysqli_query($connexion, $requete);
	if ($dataset == FALSE) {
		echo "Aucune donnée fournie dans la base de donnée ou échec de connexion à la BD hihi";
		return -1; // sinon on retourne 1 pour savoir qu'il y a eu un erreur
	} else {
		$row = mysqli_fetch_all($dataset, MYSQLI_BOTH); // On met tout dans un tableau associatif et numérique
		return $row; // on return le tableau

	}
}

function getPlantes($connexion)
{
	$requete =  "SELECT * FROM p1926543.Plantes";
	$res = mysqli_query($connexion, $requete);
	if ($res != FALSE) {
		$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $row;
	}
	echo ('erreur');
	return -1;
}


function insertVarieteFromDataset($connexion, $data)
{
	for ($i = 0; $i < 9; $i++) {
		$data[$i] = mysqli_real_escape_string($connexion, $data[$i]); // on transforme les data pour proteger les caractères spéciaux
	}
	$requete = "INSERT INTO p1926543.Variété (nom_var, annee_marche, precocite, comm_var) VALUES ('$data[0]', '$data[6]', '$data[4]', '$data[3]')";
	$inser = mysqli_query($connexion, $requete); //envoi de la requête 
	echo "$inser";
	if ($inser == FALSE) {
		return false;
	}
	return true;
}

//faire une fonction qui recupère chaque type UNIQUE pour le mettre dans la table type_plante

function getType_plante($connexion)
{
	$requete = "SELECT Id_Typeplante FROM p1926543.Plantes";
	$res = mysqli_query($connexion, $requete);
	if ($res != FALSE) {
		$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $row;
	}
	return -1;
}



function getVariété($connexion)
{
	$requete =  "SELECT nom_var, annee_marche, precocite FROM p1926543.Variété";
	$res = mysqli_query($connexion, $requete);
	if ($res != FALSE) {
		$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $row;
	}
	return -1;
}

// nombre d'instances d'une table $nomTable
function countInstances($connexion, $nomTable)
{
	$requete = "SELECT COUNT(*) AS nb FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	if ($res != FALSE) {
		$row = mysqli_fetch_assoc($res);
		return $row['nb'];
	}
	return -1;  // valeur négative si erreur de requête (ex, $nomTable contient une valeur qui n'est pas une table)
}


// retourne les instances d'une table $nomTable
function getInstances($connexion, $nomTable)
{
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}


function getTypes($connexion, $nomTable)
{
	$requete = "SELECT DISTINCT Id_Typeplante FROM Plantes WHERE ID_Typeplante IS NOT NULL GROUP BY `Id_Typeplante` ORDER BY Id_Typeplante";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function getidv($connexion)
{

	$id = mysqli_insert_id($connexion);
	return $id;
}

function exists($connexion, $nom)
{
	$nomVariete = mysqli_real_escape_string($connexion, $nom); // securisation de la valeur saisie
	$requete = "SELECT * FROM Variete WHERE nom_var = '" . $nomVariete . "'";
	$verification = mysqli_query($connexion, $requete);
	if ($verification == FALSE || mysqli_num_rows($verification) == 0) // pas de variété avec ce nom
		return FALSE;
	return TRUE;
}

function IntegVariete($connexion)
{
	$variete = getVariété($connexion, "DonneesFournies");
	$indi = 0;
	foreach ($variete as $val) {
		$indi += 1;
		$v1 = $val['nom_var'];
		$v2 = $val['annee_marche'];
		$v3 = $val['comm_vaR'];
		$v4 = $val['precocite'];
		$requete = "INSERT INTO Variété VALUES($indi, '$v1', '$v2', '$v4', NULL, NULL, NULL, NULL, '$v3', '', '')";
		$res = mysqli_query($connexion, $requete);
		echo "done integerating";
	}
}

function search($connexion, $table, $valeur) {
	$valeur = mysqli_real_escape_string($connexion, $valeur); // au cas où $valeur provient d'un formulaire
	if($table == 'Variété')
		$requete = 'SELECT * FROM Variété WHERE nom_var LIKE \'%'.$valeur.'%\';';
	else  // $table == 'PLANTE'
		$requete = 'SELECT * FROM Plantes WHERE nom_pl LIKE \'%'.$valeur.'%\' OR nom_Lat LIKE \'%'.$valeur.'%\';';
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_array($res, MYSQLI_ASSOC);
	return $instances;
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

function randPlantes($connexion){
	$requete = "SELECT nom_pl FROM Plantes ORDER BY RAND() LIMIT 2";
	$res = mysqli_query($connexion,$requete); //execute la requete 
	if ($res !=FALSE){
		$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $row;
	}
	return -1;
}
	