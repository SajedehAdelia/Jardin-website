<?php
// connexion à la BD, retourne un lien de connexion
include 'modele/modele.php';
$connexion = connectBD();

		//here is the button add for adding the varities to the site
		if(isset($_POST['submit']))
		{
            if(!empty($_POST['nom_var']) && !empty($_POST['annee_marche'])){
                $nom_var= $_POST['nom_var'];
                $annee_marche= $_POST['annee_marche'];
                $comm_var= $_POST['comm_var'];

                $query="INSERT INTO Variété(nom_var, annee_marche, comm_var)values('$nom_var' , '$annee_marche', '$comm_var')";

                $run= mysqli_query($connexion, $query) or die(mysqli_error());
                    if($run){
                        echo "soumis avec succès";
                    } else{

                        echo "not submitied";
                    }

            }else{
                echo "tous les champs reçus";
            }
		}
		?>
