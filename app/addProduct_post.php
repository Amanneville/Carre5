<?php

declare(strict_types=1);
require 'includes/config.php';


# -------------------------------------- #
## AJOUT PRODUIT DANS LA BDD ##
# -------------------------------------- #

# ---------------------------------- #
##  RÉCEPTION DES DONNÉES   ##
# ---------------------------------- #

// vérif champs non vides //
if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['dlc'])) {
    // || empty($_POST['category'])
    header('Location: add-products.php?error=missingInput');
    exit();
    // si tout ok = initialisation des variables + assainir 
} else {
    $name = trim(htmlspecialchars($_POST['name']));
    $description = trim(htmlspecialchars($_POST['description']));
    $price = trim(htmlspecialchars($_POST['price']));
    $dlc = trim(htmlspecialchars($_POST['dlc']));
    // $category = trim(htmlspecialchars($_POST['category']));

    // initialisation de la var image
    $image = $_FILES['image'];
}

# ----------------------------------- #
##  VALIDATION DES DONNÉES   ##
# ----------------------------------- #

// vérif nom produit entre 5 & 20 caract. //
if (strlen($name) < 5 || strlen($name) > 20) {
    // echo '<br>' . "Le nom du produit doit contenir plus de 5 caractères et moins de 20."
    //     . '<br>' . '<a href="add-products.php">' . "Retour à la création de produit" . '</a>';
    header('Location: add-products.php?error=shortNameProduct');
    exit();
}
// vérif description produit au moins 20 caract. //
if (strlen($description) < 20) {
    // echo '<br>' . "La description du produit doit contenir au moins 20 caractères."
    //     . '<br>' . '<a href="add-products.php">' . "Retour à la création de produit" . '</a>';
    header('Location: add-products.php?error=shortDescriptProduct');
    exit();
}
//  vérif prix positif //
if ($price <= 0) {
    // echo '<br>' . "Le prix doit être positif."
    //     . '<br>' . '<a href="add-products.php">' . "Retour à la création de produit" . '</a>';
    header('Location: add-products.php?error=positivePrice');
    exit();
}

## !! vérif catégories à insérer ##

// vérif produit unique (sur le nom) //
try {
    $bdd_prdtUniq = 'SELECT COUNT(*) FROM product WHERE name = :name';
    $req_prdtUniq = $db->prepare($bdd_prdtUniq);
    $req_prdtUniq->bindvalue(':name', $name, PDO::PARAM_STR);
    $req_prdtUniq->execute();

    $result_req = $req_prdtUniq->fetchColumn();
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
if ($result_req > 0) {
    header('Location: add-products.php?error=nameProductExits');
    exit();
}

# --------------------- #
##  UPLOAD IMAGE  ##
# --------------------- #

// Après avoir initialisé le fichier dans $image on vérifie que celui-ci soit de la bonne taille avant de continuer //
if ($image['size'] > 0 && $image['size'] <= 1000000) {
    // On vérifie dans un premier temps l'extension du fichier qui est uploadé
    // on crée un array d'extensions valides et ensuite on va comparer ces extensions valides par rapport à l'extension du fichier reçu.
    $valid_ext = ['png', 'jpeg', 'jpg', 'gif'];
    $get_ext = strtolower(substr(strrchr($image['name'], '.'), 1));

    if (!in_array($get_ext, $valid_ext)) {
        echo 'image format is invalid';
        header('Location:addOffers.php?error=invalidImageFIle');
        exit();
    }

    // On procède de la même façon pour la vérification du type //
    $valid_type = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
    if (!in_array($image['type'], $valid_type)) {
        echo 'image type is invalid';
        header('Location:addOffers.php?error=invalidImageFile');
        exit();
    }
    // ! Ne pas oublier de créer le dossier public/uploads parfois des problèmes de droits risquent de limiter l'accès
    // ? On crée le chemin intégral du fichier
    $image_path = 'public/uploads/' . uniqid() . '/' . $image['name'];

    // ? On crée le dossier qui va accueillir le fichier
    mkdir(dirname($image_path));

    // ? On réalise l'upload dans le serveur au chemin précédemment déclaré
    if (!move_uploaded_file($image['tmp_name'], $image_path)) {
        echo 'couldn\'t upload';
        header('Location:addOffers.php?error=uploadError');
        exit();
    }
    // sinon image par défaut //
} else {
    $image_path = 'public/uploads/noimg.png';
}


# ---------------------------------------- #
##  si tout ok == AJOUT DANS BDD   ##
# ---------------------------------------- #
try {
    $bdd_product = 'INSERT INTO product (name, description, price, dlc, image)
    VALUES (:name, :description, :price, :dlc, :image)';
    $req_product = $db->prepare($bdd_product);

    // $req_product ->bindValue(':name', $name, PDO::PARAM_STR);
    // $req_product ->bindValue(':description', $description, PDO::PARAM_STR);
    // $req_product ->bindValue(':price', $price, PDO::PARAM_INT);
    // $req_product ->bindValue(':dlc', $dlc, PDO::PARAM_STR);
    // $add_product = $req_product->execute();

    $req_product->execute(
        [':name' => $name, ':description' => $description, ':price' => $price, ':dlc' => $dlc, ':image' => $image_path]
    );
    header('Location: index.php');
    exit();
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
