<?php
require 'includes/config.php';

# ------------------------------------------------ #
## MODIFICATION D'UN PRODUIT EXISTANT ##
# ------------------------------------------------ #

if (isset($_GET)) {
    if (isset($_GET['edit']) && $_GET['edit'] === 'modifier' && !empty($_GET['id'])) {
        $bdd_id = 'SELECT * FROM product WHERE product_id = :id';

        $req_selectId = $db->prepare($bdd_id);
        $req_selectId->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $req_selectId->execute();
        $result_id =  $req_selectId->fetch(PDO::FETCH_OBJ);
        

        if (!empty($_POST) && isset($_POST)) {
    
            $edit_product = 'UPDATE product SET name = :name, description = :description, price = :price, dlc = :dlc WHERE product_id = :id';

            $req_edit_product = $db->prepare($edit_product);

            $req_edit_product->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
            $req_edit_product->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
            $req_edit_product->bindValue(':price', $_POST['price']);
            $req_edit_product->bindValue(':dlc', $_POST['dlc'], PDO::PARAM_STR);

            $req_edit_product->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

            $req_edit_product->execute();

            header('Location: index.php');
            exit();
        }
    }
}

?>

<?php include_once '_head.php'; ?>

<!-- HTML -->
<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg w-100" style="background-image: url('assets/img/curved-images/curved8.jpg');">
        <span class="mask bg-gradient-dark opacity-2"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-8">Mettre à jour un produit</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-6 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0 m-0">
                    <div class="card-body">

                        <form action="#" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="name">Nom du produit</label>
                                <input class="form-control" type="text" name="name" id="name" value="<?= (isset($result_id) && !empty($result_id)) ? $result_id->name : ""; ?>">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input class="form-control" type="text" name="description" id="description" value="<?= (isset($result_id) && !empty($result_id)) ? $result_id->description : ""; ?>">
                            </div>

                            <div class="row">
                                <div class=" col form-group">
                                    <label for="price">Prix produit (€)</label>
                                    <input class="form-control" type="number" step="any" name="price" id="price" value="<?= (isset($result_id) && !empty($result_id)) ? $result_id->price : ""; ?>">
                                </div>

                                <div class="col form-group">
                                    <label for="dlc">Date limite de consommation</label>
                                    <input class="form-control" type="date" name="dlc" id="dlc" value="<?= (isset($result_id) && !empty($result_id)) ? $result_id->dlc : ""; ?>">
                                </div>
                            </div>

                            <!-- MAJ IMAGE -->
                            <div class="form-group text-center">
                                <img src="<?= (isset($result_id) && !empty($result_id)) ? $result_id->image : ""; ?>" alt="" class="img-fluid" style="width: 150px;">

                                <p class="text-start">modifier l'image :</p>
                                <input class="form-control  btn-info" type="file" id="formFile" name="image" accept="image/png, image/jpeg, image/jpg, image/gif">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-50 my-4 mb-2">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-5">
        <a href="index.php">Annuler</a>
    </div>
</section>

<?php
include_once '_footer.php';
?>