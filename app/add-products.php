<?php
require '_head.php';
require '_navbar.php';
# require '_sql_fetchCategories.php';

# -------------------------------------------------- #
## AJOUT D'UN PRODUIT via un FORMULAIRE ##
# -------------------------------------------------- #

# ----------------------------------------------- #
## GESTION MESSAGES ERREUR de la PAGE ##
# ----------------------------------------------- #
$alert = false;
if (!empty($_GET)) {
    $alert = true;
    if ('missingInput' == $_GET['error']) {
        $type = 'danger';
        $message = 'Vous devez remplir tous les champs du formulaire !';
    }
    if ('shortNameProduct' == $_GET['error']) {
        $type = 'warning';
        $message = 'Le nom du produit doit contenir plus de 5 caractères et moins de 20.';
    }
    if ('shortDescriptProduct' == $_GET['error']) {
        $type = 'warning';
        $message = 'La description du produit doit contenir au moins 20 caractères.';
    }
    if ('positivePrice' == $_GET['error']) {
        $type = 'danger';
        $message = 'Le prix du produit doit être supérieur à zéro.';
    }
    if ('nameProductExits' == $_GET['error']) {
        $type = 'warning';
        $message = 'Ce produit existe déjà !';
    }
}
?>

<!-- HTML -->
<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-2 pb-11 m-3 border-radius-lg w-100" style="background-image: url('assets/img/curved-images/curved1.jpg');">
        <span class="mask bg-gradient-dark opacity-2"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-8">Création d'un nouveau produit</h1>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-6 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0 m-0 p-2">
                    <div class="card-body">

                        <!-- FORM HTML -->
                        <form action="addProduct_post.php" method="post" class="container" enctype="multipart/form-data">
                            <div class=" mb-3">
                                <label for="name">Nom du nouveau produit</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="nom produit">
                            </div>

                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="2" placeholder="description produit"></textarea>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="price">Prix produit (€)</label>
                                    <input type="number" step="any" name="price" id="price" class="form-control" placeholder="0 €">
                                </div>
                                <div class="col mb-3">
                                    <label for="dlc">Date limite de consommation</label>
                                    <input type="date" name="dlc" id="dlc" class="form-control">
                                </div>
                            </div>

                            <!-- UPLOAD IMAGE  !! type = file !! -->
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control  btn-info" type="file" id="formFile" name="image" accept="image/png, image/jpeg, image/jpg, image/gif">
                                <!-- extensions acceptées -->
                            </div>

                            <!-- catégories à insérer -->

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-50 my-4 mb-2">Ajouter le produit</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="text-center mt-5">
        <a href="index.php">Retour à l'accueil</a>
    </div>

    <!--AFFICHAGE ALERT MESSAGE ERREUR -->
    <div class="w-40 mx-auto mt-4 text-center">
        <?php if ($alert) { ?>
            <div class="alert alert-<?php echo $type; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php } ?>
    </div>
    <!-- END ALERTE -->
</section>

<?php
include_once '_footer.php';
?>