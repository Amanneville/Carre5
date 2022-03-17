<?php

declare(strict_types=1);
require 'includes/config.php';


# ----------------------------------------------------- #
## MODIFIER UN PRODUIT EXISTANT DANS BDD ##
# ----------------------------------------------------- #

// récup. du produit via l'id envoyé dans le GET //
// if (isset($_GET)) {
//     if (isset($_GET['edit']) && $_GET['edit'] === 'modifier' && !empty($_GET['id'])) {

//         $bdd_id = 'SELECT * FROM product WHERE product_id = :id';
//         $image = $_FILES['image'];

//         $req_selectId = $db->prepare($bdd_id);
//         $req_selectId->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

//         $req_selectId->execute();
//         $result_id =  $req_selectId->fetch(PDO::FETCH_OBJ);

//         // si les variables contiennent une valeur & si elles existent => mise à jour de la BDD //
//         if (!empty($_POST) && isset($_POST)) {
//             $edit_product = 'UPDATE product SET name = :name, description = :description, price = :price, dlc = :dlc, image = :image WHERE product_id = :id';
//             $req_edit_product = $db->prepare($edit_product);

//             $req_edit_product->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
//             $req_edit_product->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
//             $req_edit_product->bindValue(':price', $_POST['price']);
//             $req_edit_product->bindValue(':dlc', $_POST['dlc'], PDO::PARAM_STR);

//             $req_edit_product->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

//             $req_edit_product->execute();

//             header('Location: index.php');
//             exit();
//         }
//     }
// }

