
<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Créer un compte</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container text-center">
        <?php include("../../html/header.html")?>
        <h1>Création de compte</h1>
        <div class="m-2 p-2">
            <form name="addBook" method="post" action="#">
                <div>
                    <label class="m-2">Nom</label>
                    <input type="text" name="username"></br>
                    <label class="m-2">Password</label>
                    <input type="password" name="password"></br>
                    <input type="submit" class="btn-lg m-1" value="Add Joueur">
                </div>
            </form>
        </div>
        <?php
            include('../commun/getSQL.php');
            $username_ok=0;
            if (isset($_POST['username'])){
                /*Engistrement du nouvel utilisateur*/
                /*Vérification que la valeur username n'existe pas dans la base de données player*/
                $allusername = getSqlArray('SELECT `name` FROM `user`', 1);
                /*Pour chaque utilisateur verification avec POSTusername et DBusername*/
                foreach ($allusername as $username_DB){
                    if ($username_DB == $_POST['username']){
                        $username_ok=1;
                        echo '<p class="text-center" style="color:red">Attention ! Username déjà utilisé.<p>';
                    }
                }
            }
            if ($username_ok==0){
                /*Si la valeur de password n'est pas vide*/
                if (isset($_POST['password'])){
                    /*Si OK alors rajout de l'utilisateur dans la base de données player*/
                    $insert_sql_new_user = 'INSERT INTO `user`(`name`, `password`) VALUES ("'.$_POST['username'].'","'.$_POST['password'].'")';
                    requetSql($insert_sql_new_user);
                    /*Aller sur la page index.php*/                            
                    header('Location: connexion.php');
                }
            } 
        ?>
        <?php include("../../html/footer.html")?>    
       
    </body>
</html>