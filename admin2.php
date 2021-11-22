<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$membres = $bdd->query("SELECT * FROM utilisateurs");



// supprimer un membre

if (isset($_GET['supprimer']) and !empty($_GET['supprimer'])) {
   
    $supprime = intval($_GET['id']);
    $req = $bdd->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $req->execute(array($supprime));
    header("Location: ./admin.php");

}


//editer un membre
if (isset($_POST["update"]) && !empty($_POST["update"]) || (isset($_POST["nom"]) && !empty($_POST["nom"])) || (isset($_POST["email"]) && !empty($_POST["email"]))) {
    var_dump($_POST);
$email = htmlspecialchars($_POST["email"]);
$prenom = htmlspecialchars($_POST["prenom"]);
$nom = htmlspecialchars($_POST["nom"]);
$passe = sha1($_POST["password"]);


$updateusers = $bdd->prepare("UPDATE utilisateurs SET  nom=?, prenom=?, login=?, WHERE id=?");
$updateusers->execute(array($prenom,$nom,$email,$passe,$_SESSION['id'] ));
        header("Location: ./admin.php");
    
    }
?>






<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord</title>
</head>

<body>
<div><h1>page admin</h1></div>
    <table>
        <thead>

            <tr>
                <th>id</th>
                <th>prenom</th>
                <th>nom</th>
                <th>login</th>
                <th>password</th>
                <th>delete</th>
                <th>editer</th>


            </tr>

        </thead>
        <tbody>

            <?php while ($m = $membres->fetch()) { ?>
                <tr>
                    <th><input type="text" name="id" id="" value=" <?= $m["id"] ?>"></th>
                    <th><input type="email" name="email" id="" value="<?= $m["prenom"] ?>"></th>
                    <th><input type="email" name="email" id="" value="<?= $m["nom"] ?>"></th>
                    <th><input type="email" name="email" id="" value="<?= $m["login"] ?>"></th>
                    <th><input type="password" name="password" id="" value=" <?= $m["password"] ?>"></th>
                    <th><form action="#" method="get"> <input type="hidden" name="id" value="<?php echo $m["id"]; ?>"><input name="supprimer" type="submit" value="supprimer"> </form></th>
                    <th><form action="#" method="post"><input type="hidden" name="id" value="<?php echo $m["id"]; ?>"><input name="update" type="submit" value="update"></form></th>
            <?php } ?>
        </tbody>
    </table>

    

</body>

</html>