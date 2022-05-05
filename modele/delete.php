<?php

// Using database connection file here
include "all_records.php";


$connexion = connectBD();
$id = $_GET['nom_pl']; // get id through query string

$result = mysqli_query($connexion,"DELETE FROM Plantes where nom_pl=$id"); // delete query

if($result)
{
    mysqli_close($connexion); // Close connection
    header("location:all_records.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>