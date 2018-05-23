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
                    <h1 class="text-center">Partie gagnée</h1>
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
            <?php
            $image=array("victory1.gif","victory2.gif","victory3.jpg","victory4.jpg","victory5.jpg","victory6.jpg","victory7.jpg");
            $de = rand(0, 6);
            echo'<img src="../../images/victory/'.$image[$de].'" alt="winner">';
            ?>
            
        </div>
    </div>
</body>
</html>