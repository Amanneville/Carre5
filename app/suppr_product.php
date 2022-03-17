<?php

declare(strict_types=1);
require 'includes/config.php';

# -------------------------------------------- #
## SUPPRIMER UN PRODUIT DE LA BDD ##
# -------------------------------------------- #


## MÉTHODE GET () ##
// if (isset($_GET)) {
//     if (isset($_GET['delete']) && $_GET['delete'] === 'supression') {
//         $bdd_delete = 'DELETE FROM product WHERE product_id = :id';
//         $req_delete = $db->prepare($bdd_delete);
//         $req_delete->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
//         $req_delete->execute();
//         header('Location: index.php');
//         exit();
//     }
// }

## MÉTHODE POST avec un FORM caché ##
$product_id = filter_input(INPUT_POST, 'product_id');
$token = filter_input(INPUT_POST, 'csrf_token');

// récup. token créé à la connexion //
if ($token !== $_SESSION['token']) {
}
// echo '<pre>';
// var_dump($token, $username, $_POST);
// echo '</pre>';

try {
    $bdd_deleteProduct = 'DELETE FROM product WHERE product_id = :product_id';

    $req_deleteProduct = $db->prepare($bdd_deleteProduct);
    $req_deleteProduct->bindValue(':product_id', $product_id);

    $req_deleteProduct->execute();

    header('Location: index.php');
} catch (\PDOException $e) {
    echo 'Erreur :' . $e->getMessage();
}
