<?php
require('./fileconfig/startbdd.php');


if (isset($_POST['submit-insc'])) {
    if (!empty($_POST["email"]) && !empty($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["password"]) && !empty($_POST["repassword"])) {
        // les variable je dois les rappeles 
        $email = htmlspecialchars($_POST["email"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $nom = htmlspecialchars($_POST["nom"]);
        $passe = sha1($_POST["password"]);
        //$passe = $_POST["password"];
        $confir_key = sha1($_POST["repassword"]);
        //$confir_key = $_POST["repassword"];
        // verification modepasse
        if ($passe == $confir_key) {
            // verification email exist
            $reqmail = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? and password = ?");
            $reqmail->execute(array($email, $passe));
            $reqmailcount = $reqmail->rowCount();
            if ($reqmailcount != 1) {
                $reqmail = $bdd->prepare("INSERT INTO utilisateurs ( login, prenom, nom, password) VALUE (?, ?, ?, ?)");
                $reqmail->execute(array($email, $prenom, $nom, $passe));
                header('Location: ./connexion.php');  
            } else {
                $error = 'le compte est deja existant';
            }
        } else {
            $error = 'les mots de passe ne sont pas identiques';
        }
    } else {
        $error = 'les champs sont vides';
    }
}else {
    $error = 'oui';
}


?>

<!DOCTYPE html>
<html lang="fr">
   

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
</head>
   

<body>   

<?php require("./fileconfig/header.php");  

?>
  
   <div class="container">
        <div class="item2">
        <h1>Inscrivez-vous</h1>   
    <form action="" method="post">
        <h2>Prenom</h2>
        <input type="text" name="prenom" id="" placeholder="toto">
        <h2>Nom</h2>
        <input type="text" name="nom" id="" placeholder="lechat">
        <h2>E-Mail</h2>
        <input type="text" name="email" id="" placeholder="lechat@detoto.io">
        <h2>Mot de Passe</h2>
        <input type="password" name="password" id="" placeholder="titi13">
        <h2>Confirmation du Mot de Passe</h2>
        <input type="password" name="repassword" id="" placeholder="titi13">
        <h2>Submit</h2>
        <input type="submit" name="submit-insc" value="inscription">
     

    </form>

    <a id="lien" href="connexion.php">Connexion</a>
    <p style="color: red;">
        <?php if (isset($error)) {
            echo $error;
        } ?>
    </p>
</div>
</div>
</body>

</html>