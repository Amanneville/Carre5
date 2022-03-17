<?php
require '_head.php';
require 'includes/config.php';

## LECTURE FICHE PRODUIT ##
# ------ affiche 1 produit ----- #
# ------------------------------- #

if (isset($_GET['id'])) {

    $bdd_read_id = 'SELECT * FROM product WHERE product_id = :id';

    $req_read = $db->prepare($bdd_read_id);
    $req_read->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $req_read->execute();
    $result_read_product =  $req_read->fetch(PDO::FETCH_OBJ);

    echo '<pre>';
    print_r($result_read_product);
    echo '</pre>';
}
?>

<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg w-100" style="background-image: url('assets/img/curved-images/curved6.jpg');">
        <span class="mask bg-gradient-dark opacity-2"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-8">Fiche produit</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-6 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0 m-0">
                    <div class="card-body">

                        <div class="col">
                            <h3 class="textGradient"><?= $result_read_product->name ?></h3 class="textGradient">
                            <p class="mt-4"><?= $result_read_product->description ?></p>
                        </div>

                        <!-- insérer catégories -->

                        <div class="row mt-6">
                            <div class="col">
                                <p><strong>Prix : </strong> <?= $result_read_product->price ?> €</p>
                            </div>
                            <div class="col">
                                <p><strong>DLC : </strong> <?= $result_read_product->dlc ?></p>
                            </div>
                        </div>

                        <div class="col">
                            IMAGE
                            <td class="align-middle text-center">
                                <img src="<?= $result_read_product->image ?>" alt="" class="img-fluid" style="width: 80px;">
                            </td>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-5">
        <a href="index.php">Retour à l'accueil</a>
    </div>
</section>

<?php
include_once '_footer.php';
?>