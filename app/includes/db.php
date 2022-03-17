<?php
require 'env.php';

# ------------------------------ #
## CONNECTION A LA BDD ##
# ------------------------------ #

$db_bdd ='mysql:dbname='.DBNAME. ';host='.HOST;

try {
    $db = new PDO($db_bdd, USER, PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // echo "Connexion à la BDD OK";
} catch (PDOException $e) {
    echo "Erreur :  " . $e->getMessage();
}
?>

