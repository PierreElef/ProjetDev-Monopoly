<?php
    session_start();
    include("../commun/getSQL.php");
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
    <title>Monopoly - connexion</title>
</head>
<html>
<body style="background-color: #dae9d4;">
    <header class="text-center">
        <?php include("../../html/header2.html")?>
        <h1>Connexion</h1>
    </header>
    <div class="container">
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
                
                //si la valeur postée de username n'est pas vide
                if (isset($_POST['username'])){
                    //récupération du password dans la base de données pour username
                    $passwordDB = getSql('SELECT `password` FROM `user` WHERE `name`="'.$_POST['username'].'"');
                    //si le password correspond
                    if ($_POST['password'] == $passwordDB){
                        //récupération de ID de l'utilisateur de la session
                        $id=getSql('SELECT `ID` FROM `user` WHERE `name`="'.$_POST['username'].'"');
                        settype($id, "int");
                        $_SESSION["id"]=$id;
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
    </div>
    <footer>
        <?php include("../../html/footer.html")?>
    </footer>
    </body>
</html>