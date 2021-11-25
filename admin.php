<?php
require('./fileconfig/startbdd.php');
require('./fileconfig/userrecup.php');
require('./fileconfig/userall.php');

if (isset($recupinfos['login']) and $recupinfos['login'] == 'admin') {


    if (isset($_GET['supprimer']) and !empty($_GET['supprimer'])) {

        $supprime = intval($_GET['id']);
        $req = $bdd->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $req->execute(array($supprime));
        header("Location: ./admin.php");
    }

  



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashbord</title>
    </head>

    <body>


    <?php require("./fileconfig/header.php");  

?>


        <div class="container">
            <div class="item2">


                <table>
                    <thead>

                        <tr>
                            <th>id</th>
                            <th>prenom</th>
                            <th>nom</th>
                            <th>login</th>
                            <th>password</th>
                            <th>delete</th>


                        </tr>

                    </thead>
                    <tbody>

                        <?php while ($m = $recupall ->fetch()) { 
                           ?>
                            
                            <tr>
                                <th><input type="id" name="id" id="" value=" <?= $m["id"] ?>"></th>
                                <th><input type="text" name="prenom" id="" value="<?= $m["prenom"] ?>"></th>
                                <th><input type="text" name="nom" id="" value="<?= $m["nom"] ?>"></th>
                                <th><input type="text" name="login" id="" value="<?= $m["login"] ?>"></th>
                                <th><input type="password" name="password" id="" value=" <?= $m["password"] ?>"></th>
                                <th>
                                    <form action="#" method="get"> <input type="hidden" name="id" value="<?php echo $m["id"]; ?>"><input name="supprimer" type="submit" value="supprimer"> </form>
                                </th>
                  
                            

                                
                              

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </body>

    </html>

<?php } else{
    header("Location:index.php");
    # code...
}


?>