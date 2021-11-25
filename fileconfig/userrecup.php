<?php




$recup = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
$recup ->execute(array($_SESSION['id']));
$recupinfos=$recup->fetch();
?>
