<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="monProjet.css" />
        <title>TP Température Villes</title>
    </head>
<body>

<?php

try
{
	$bdd = new PDO('sqlite:temperatureVilles.sqlite');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$liste_villes = $bdd->query('SELECT ville FROM temperaturevilles');

?>

<form method="post" action="affichageTemperature.php">
   <p>
        
		<label for="ville">Ville </label>
		<select name="ville">        
		<?php
            while ($donnee = $liste_villes->fetch())
            {
                // ucfirst : 1ere lettre en majuscule; htmlspecialchars : protection faille XSS
				echo '<option value="' . htmlspecialchars($donnee[ville]) . '">' . ucfirst($donnee[ville]) . '</option>';
            }
        ?>
        </select>
        <input type="submit" value="Valider" />
        
   </p>
</form>


<?php
$liste_villes->closeCursor();
?>
</body>
