<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Connexion</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container text-center">
        <?php include("../html/header.html")?>
        <h1>Connexion</h1>
        <?php
            if (isset($_POST['username'])){
                $username = $_POST['username'];
            }
        ?>
        <div class="text-center p-2 m-2">
            <form method="post" action="#" class="text-center">
            <label class="m-2">Username</label>
            <input type="text" name="username"  value="<?php $username ?>" required><br/>
            <label class="m-2">Password</label>
            <input type="password" name="password" required><br/>
            <input type="submit" class="btn-lg m-1" value="Confirmer" />
            <p class="m-2">Nouvel utilisateur ? <a href="creationPlayer.php">S'enregistrer</a></p>
            <?php
                //Vérification du password   
                include('getSql.php');
                //si la valeur postée de username n'est pas vide
                if (isset($_POST['username'])){
                    //récupération du password dans la base de données pour username
                    $passwordDB = getSql('SELECT `password` FROM `player` WHERE `username`="'.$_POST['username'].'"');
                    //si le password correspond
                    if ($_POST['password'] == $passwordDB){
                        //récupération de ID de l'utilisateur de la session
                        $_SESSION["id"]=getSql('SELECT `ID` FROM `player` WHERE `username`="'.$_POST['username'].'"');
                        //aller à la page myBibliotheque
                        header('Location: PlayGame.php');
                    }else{
                        //message si password faux ou utilisateur introuvable
                        echo '<p class="text-center" style="color:red">Attention ! Mauvais mot de passe ou utilisateur incorrect !<p>';
                    }
                }
            ?>
            </form>
        </div>
        <?php include("../html/footer.html")?>
    </div>
       
    </body>
</html>