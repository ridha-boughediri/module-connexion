<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['submit-connect'])) {
    $email = htmlspecialchars($_POST["email"]);
    $passe = sha1($_POST["password"]);
    if(!empty($email) && !empty($passe)){
        $recup = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        $recup->execute(array($email, $passe));
        $count= $recup->rowCount();

        if ($count == 1) {
            
            $affich = $recup->fetch();
            $_SESSION["id"] = $affich["id"];
            header("Location: ./profil.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
   

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
   

<body>      
     <h1>Connectez-vous</h1>   
    <form action="" method="post">
        <h2>E-Mail</h2>
        <input type="email" name="email" id="" placeholder="lechat@detoto.io">
        <h2>Mot de Passe</h2>
        <input type="password" name="password" id="" placeholder="titi13">
        <h2>Submit</h2>
        <input type="submit" name="submit-connect" value="connexion">

    </form>

    <a id="lien" href="./inscription.php">Inscription</a>
    <p style="color: red;">
        <?php if (isset($error)) {
            echo $error;
        } ?>
    </p>
       
</body>

</html>