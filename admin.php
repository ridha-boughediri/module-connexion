<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$membres = $bdd->query("SELECT * FROM utilisateurs");





if (isset($_GET['supprimer']) and !empty($_GET['supprimer'])) {
   
    $supprime = intval($_GET['id']);
    $req = $bdd->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $req->execute(array($supprime));
    header("Location: ./admin.php");

}

if(isset($_GET['ajouter']) AND !empty($_GET['ajouter'])) {
       $confirme = (int) $_GET['id'];
       var_dump($_GET);
       $req = $bdd->prepare('UPDATE utilisateurs SET id = 1 WHERE id = ?');
       $req->execute(array($confirme));
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
                <th>add member</th>
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
                    <th>
                        <form action="#" method="get"> <input type="hidden" name="id" value="<?php echo $m["id"]; ?>"><input name="supprimer" type="submit" value="supprimer"> </form>
                    </th>
                    <!-- <th><form action="#"   method="post"><input name="hidden" type="submit" value="<?php echo $m["id"]; ?>"><input  name="editer" type="submit" value="modifier"> </form></th> -->
                    <th>
                        <form action="#" method="post"><input type="hidden" name="id" value="<?php echo $m["id"]; ?>"><input name="ajouter" type="submit" value="ajouter"></form>
                    </th>

                </tr>
            <?php } ?>
        </tbody>
    </table>



</body>

</html>