<?php

## REQUÊTE ---------------------------#
## AFFICHAGE LISTE DES PRODUITS ##
## dans index.php si USER connecté ##

try {
    $product_connect = 'SELECT * FROM product';
    $req_list_product = $db->prepare($product_connect);

    $req_list_product->execute();

    $product_list = $req_list_product->fetchAll(PDO::FETCH_OBJ);

    // echo '<pre>';
    // print_r($product_list);
    // echo '<\pre>';

} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
