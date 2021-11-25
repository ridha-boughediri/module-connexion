<?php
require('./fileconfig/startbdd.php');
require('./fileconfig/userrecup.php');



if (isset($_SESSION['id'])) {
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




    }


}
        // afficher le lien si l'user est admin
if (isset($recupinfos['login']) and $recupinfos['login'] == 'admin') {
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFIL</title>
</head>

<body>

<?php require("./fileconfig/header.php");  

?>
  
    <div class="container2">
  <div class="item2">

  <div class="container">
        <h2>Quelques informations sur vous : </h2>
    <form action="" method="post">
        <h2>ID :</h2>
        <input type="text" name="id" id="" value=" <?php echo $userinfo['id'] ?>">
        <h2>Prenom</h2>
        <input type="text" name="prenom" id="" value="<?php echo $userinfo['prenom'] ?>">
        <h2>Nom</h2>
        <input type="text" name="nom" id="" value="<?php echo $userinfo['nom'] ?>">
        <h2>E-Mail</h2>
        <input type="text" name="email" id="" value="<?php echo $userinfo['login'] ?>">
        <h2>Mot de Passe</h2>
        <input type="password" name="password" id="" value=" <?php echo $userinfo['password'] ?>">


        <input type="submit" name="update" name=""value="modifier">
      <?php  if (isset($recupinfos['login']) and $recupinfos['login'] == 'admin') {?>
        <a href="admin.php">espace admin</a>

<?php } ?>
        

    </form>
    </div>
  </div>
</div> 
</body>

</html>
