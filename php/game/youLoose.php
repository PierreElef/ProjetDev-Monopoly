<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
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