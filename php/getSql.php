<?php
function getSql($sql){
	$user = 'root';
	$password = '';
	$db = 'monopoly';
	$host = 'localhost';
	$port = 3306;
	// Connexion à la BDD
	$link = mysqli_init();
	$success = mysqli_real_connect(
    	$link, 
    	$host, 
    	$user, 
    	$password, 
    	$db,
    	$port
    );
	// Execution de la requete ET renvoi d'erreur si echec d'execution
	$ret = NULL;
	$ret = mysqli_query($link, $sql) or die ('Erreur SQL. Detail : '.mysqli_error($link));
	// get result
	if ($ret != false) {
		$row = mysqli_fetch_row($ret);
		$result = $row[0];
	}
	else {
		$result = "error";
	}
	mysqli_free_result($ret);
	// Fermeture de la connexion
	mysqli_close($link);
	return ($result);
}

/*
Return the array of the 
*/
function getSqlArray($sql, $rowNbr) {
	$user = 'root';
	$password = '';
	$db = 'monopoly';
	$host = 'localhost';
	$port = 3306;

	// Connexion à la BDD
	$link = mysqli_init();
	$success = mysqli_real_connect(
    	$link, 
    	$host, 
    	$user, 
    	$password, 
    	$db,
    	$port
    );
	// Execution de la requete ET renvoi d'erreur si echec d'execution
	$ret = NULL;
	$ret = mysqli_query($link, $sql) or die ('Erreur SQL. Detail : '.mysqli_error($link));
	// get result
	$result = array();
	if ($ret != false) {
		while ($row = mysqli_fetch_row($ret)) {
			array_push($result, $row[$rowNbr-1]);
		}
	}
	else {
		$result = "error";
	}
	mysqli_free_result($ret);
	// Fermeture de la connexion
	mysqli_close($link);
	return ($result);
}
function requetSql($sql)
{
    $user = 'root';
    $password = '';
    $db = 'monopoly';
    $host = 'localhost';
    $port = 3306;   
    // Connexion à la BDD
    $link = mysqli_init();
    $success = mysqli_real_connect(
       $link, 
       $host, 
       $user, 
       $password, 
       $db,
       $port
    );
    // Execution de la requete ET renvoi d'erreur si echec d'execution
    mysqli_query($link, $sql) or die ('Erreur SQL. Detail : '.mysqli_error($link));
    // Fermeture de la connexion
    mysqli_close($link);
    //echo 'succes !';
}
?>