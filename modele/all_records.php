<!DOCTYPE html>
<html>
<head>
  <title>Display all records from Database</title>
</head>
<body>

<h2>Les noms des varietes</h2>

<table border="2">
  <tr>
    <td>nom_pl</td>
    <td>nom_Lat</td>
    <td>nom_var</td>
    <td>Delete</td>
  </tr>

<?php
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
    echo "connect";
	return $connexion;
}
//i  had to add to this the connection cause otherwise it would of given me the bizarre errors
// déconnexion de la BD
function deconnectBD($connexion)
{
	mysqli_close($connexion);
}
$connexion = connectBD(); // connexion à la BD
$records = mysqli_query($connexion,"SELECT nom_pl, nom_Lat, nom_var from Plantes"); // fetch data from database
echo gettype($records);
while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['nom_pl']; ?></td>
    <td><?php echo $data['nom_Lat']; ?></td>
    <td><?php echo $data['nom_var']; ?></td>    
   
    <td><a href="delete.php?id=<?php echo $data['nom_pl'];?>">Delete</a></td>
  </tr>	
<?php
}

?>
</table>

</body>
</html>