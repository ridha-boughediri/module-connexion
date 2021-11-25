<?php
session_start();

$bdd = new PDO('mysql:host=localhost:3306 ;dbname=ridha-boughediri_moduleconnexion', 'ridha-boughediri', '1234fivem@@@');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>

