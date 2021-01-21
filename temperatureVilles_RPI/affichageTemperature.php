<?php
session_start();
?>
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
	$bdd = new PDO('sqlite:'.dirname(__FILE__).'/temperatureVilles.sqlite');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

//https://www.w3resource.com/sqlite/sqlite-time.php

//$req = $bdd->prepare('SELECT temperature, time(last_update,) AS heure, MINUTE(last_update) AS minute FROM temperaturevilles WHERE ville = ?');
$req = $bdd->prepare("SELECT temperature, time(last_update) AS heure FROM temperaturevilles WHERE ville = ?");
$req->execute(array($_POST['ville']));


$data = $req->fetch();
// ucfirst : 1ere lettre en majuscule; htmlspecialchars : protection faille XSS
//echo 'A '. $data['heure'] . 'h' . $data['minute'] .' il faisait '. $data['temperature'] . '° à '. ucfirst(htmlspecialchars($_POST['ville']));
echo 'A '. $data['heure'] . ' il fait '. $data['temperature'] . '° à '. ucfirst(htmlspecialchars($_POST['ville']));

$req->closeCursor();
?>

</body>
