<?php
require 'includes/config.php';

require '_head.php';
require '_navbar.php';

# ----------------------------------------------------- #
## GESTION MESSAGE SUCCESS CONNECT USER ##
# ----------------------------------------------------- #
$alert = false;
if (!empty($_GET)) {
    $alert = true;
    if ('signInok' == $_GET['success']) {
        $type = 'success';
        $message = 'Bravo, vous êtes inscrit !';
    }
}
?>

<!-- HTML -->
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ps ps--active-y">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Tables</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- AFFICHAGE MESSAGE SUCCESS -->
    <div class="w-40 mx-auto mt-4 text-center">
        <?php if ($alert) { ?>
            <div class="alert alert-<?php echo $type; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php } ?>
    </div>
    <!-- END ALERTE -->

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Table des produits</h6>
                    </div>
                    <?php
                    if (!empty($_SESSION)) {
                    ?>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID#</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nom</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Prix</th>
                                                
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                DLC</th>

                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Visuel</th>

                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <?php
                                        ## AFFICHAGE LISTE DES PRODUITS ##
                                        require 'product_list.php';
                                        foreach ($product_list as $value) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-center">
                                                        <?php echo $value->product_id; ?>
                                                </td>

                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                <?php echo $value->name; ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        <?php echo $value->price . ' €'; ?>
                                                    </p>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        <?php echo $value->dlc; ?>
                                                    </span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <!-- <img src="public/uploads/noimg.png" alt="" class="img-fluid" style="width: 50px;"> -->
                                                    <img src="<?php echo $value->image; ?>" alt="" class="img-fluid" style="width: 80px;">
                                                </td>

                                                <td class="align-middle text-center">
                                                    <a href="read_product.php?id=<?= $value->product_id; ?>" class="text-secondary font-weight-bold text-xs text-primary mx-1" data-toggle="tooltip" data-original-title="Show product">
                                                        Consulter
                                                    </a>

                                                    <a href="edit_product.php?edit=modifier&id=<?= $value->product_id; ?>" class="text-secondary font-weight-bold text-xs mx-1" data-toggle="tooltip" data-original-title="Edit product">
                                                        Modifier
                                                    </a>

                                                    <!-- SUPPR porduit -->
                                                    <!-- <a href="suppr_product.php?delete=supression&id=
                                                    #$value->product_id;  " 
                                                    class="text-secondary font-weight-bold text-xs text-danger mx-1" data-toggle="tooltip" data-original-title="Delete product">Supprimer</a> -->

                                                <td>
                                                    <form action="suppr_product.php" method="POST">
                                                        <input type="hidden" name="product_id" value="<?= $value->product_id; ?>">
                                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
                                                        <button type="submit" class="btn btn-outline-secondary btn-sm m-2">Supprimer</button>
                                                        <!-- <input type="submit" class="form-control btn btn-outline-danger col-4" value="Delete offer" /> -->
                                                    </form>
                                                </td>
                                                </td>
                                            </tr>
                                        <?php } # endforeach 
                                        ?>

                                    <?php # user non connecté
                                } else {
                                    echo '<div ' . 'class="text-center mb-5">'
                                        . '<a ' . 'href="sign-in.php">' . 'Connectez-vous pour afficher la liste des produits.';
                                }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tableau des projets</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Projet</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Budget</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Achèvement</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Spotify</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">$2,500</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">working</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">60%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0">
                                                <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; height: 600px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 333px;"></div>
    </div>
</main>

<?php
include_once '_footer.php';
?>