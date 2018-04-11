
<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Jouer une partie</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container text-center">
        <?php include("../html/header.html")?>
        <h1>Jouer au Monopoly</h1>
        <div class="row justify-content-around mb-5">
            <div class="col-3 p-2">
                <form name="createGame" method="post" action="#">
                    <div>
                        <input type="hidden" name="create" value=1></br>
                        <input class="btn-lg" type="submit" value="Créer une partie" style="font-size:18px;">
                    </div>
                </form>
            </div>
            <div class="col-3 p-2">
                <form name="joinGame" method="post" action="#">
                    <div>
                        <input type="hidden" name="join" value=1></br>
                        <input class="btn-lg" type="submit" value="Rejoindre une partie" style="font-size:18px;">
                    </div>
                </form>
            </div>
        </div>
        <?php
            include('getSQL.php');
            $username_ok=0;
            if (isset($_POST['create'])){
                
            }
            if (isset($_POST['join'])){
               
            } 
        ?>
        <?php include("../html/footer.html")?>
        
       
    </body>
</html>