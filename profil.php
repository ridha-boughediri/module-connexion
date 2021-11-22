<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
    $getid = intval($_SESSION['id']);
    $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

    if (isset($_POST['update'])) {

        
        $email = htmlspecialchars($_POST["email"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $nom = htmlspecialchars($_POST["nom"]);
        $passe = sha1($_POST["password"]);
        if (isset($_POST["prenom"]) && !empty($_POST["prenom"]) || (isset($_POST["nom"]) && !empty($_POST["nom"])) || (isset($_POST["email"]) && !empty($_POST["email"]))) {
            $updateusers = $bdd->prepare("UPDATE utilisateurs SET  nom=?, prenom=?, login=? WHERE id=?");
            $updateusers->execute(array($prenom,$nom,$email,$_SESSION['id'] ));
            header("Location: ./profil.php");
        
        }
        // if (isset($_POST["nom"]) && !empty($_POST["nom"])){
        //     $users = $bdd->prepare("UPDATE utilisateurs SET nom=? WHERE id=?");
        //     $users->execute(array($nom,$_SESSION['id'] ));
            
        // }
        // if (isset($_POST["email"]) && !empty($_POST["email"])){
        //     $upda = $bdd->prepare("UPDATE utilisateurs SET login=? WHERE id=?");
        //     $upda->execute(array($email,$_SESSION['id'] ));
            
        // }
    }


}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFIL</title>
</head>

<body>


    <div>Quelques informations sur vous : </div>
    <form action="" method="post">
        <h2>ID :</h2>
        <input type="text" name="id" id="" value=" <?php echo $userinfo['id'] ?>">
        <h2>Prenom</h2>
        <input type="text" name="prenom" id="" value="<?php echo $userinfo['prenom'] ?>">
        <h2>Nom</h2>
        <input type="text" name="nom" id="" value="<?php echo $userinfo['nom'] ?>">
        <h2>E-Mail</h2>
        <input type="email" name="email" id="" value="<?php echo $userinfo['login'] ?>">
        <h2>Mot de Passe</h2>
        <input type="password" name="password" id="" value=" <?php echo $userinfo['password'] ?>">


        <input type="submit" name="update" name=""value="modifier">

        <input type="submit" name="submit-insc" value="delete">

    </form>
</body>

</html>
