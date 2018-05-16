<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Monopoly - You Loose</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<meta http-equiv="refresh" content="1"/>-->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container">
        <header class="header">
            <?php include("../../html/header2.html")?>
            <div class="row justify-content-end">
                <div class="col-8">
                    <h1 class="text-center">Partie perdue</h1>
                </div>
                <div class="col-2">
                    <form name="quitSession" method="post" action="#" class="p-1">
                        <input type="hidden" name="quit" value=1>
                        <input type="image" src="../../images/quit.png" alt="Submit" width="32" height="32">
                    </form>
                    <?php
                        if (isset($_POST['quit'])){
                            session_destroy();
                            header('Location: ../menu/connexion.php');
                        } 
                    ?>
                </div>
            </div>
        </header>
        <div class="text-center pt-5">
            <img src="../../images/congrats-you-failed.jpg" alt="looser">
        </div>
    </div>
</body>
</html>