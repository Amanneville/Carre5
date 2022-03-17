<?php
include '_head.php';

# --------------------------------- #
## PAGE DE CONNEXION USER ##
# --------------------------------- #

# ----------------------------------------------- #
## GESTION MESSAGES ERREUR de la PAGE ##
# ----------------------------------------------- #
$alert = false;
if (!empty($_GET)) {
    $alert = true;
    if ('missingInputSign' == $_GET['error']) {
        $type = 'danger';
        $message = 'Vous devez remplir tous les champs du formulaire !';
    }
    if ('invalidInputSign' == $_GET['error']) {
        $type = 'danger';
        $message = 'Identifiant ou mot de passe incorrecte !';
    }
}
?>

<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
</div>
<main class="main-content mt-0 ps">
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-8">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-info text-gradient">Content de vous revoir !</h3>
                                <p class="mb-0">Entrez votre nom d'utilisateur et votre mot de passe pour vous connecter.</p>
                            </div>
                            <div class="card-body">
                                <!-- FORM SIGN-IN -->
                                <form role="form" action="signIn_post.php" method="POST">
                                    <label>Nom d'utilisateur</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Tapez votre nom d'utilisateur..." aria-label="username" aria-describedby="username-addon" name="username">
                                    </div>
                                    <label>Mot de passe</label>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Mot de passe" aria-label="Password" aria-describedby="password-addon" name="password">
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                        <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">S'identifier</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Vous n'avez pas de compte ?
                                    <a href="sign-up.php" class="text-info text-gradient font-weight-bold">S'inscrire</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/img/curved-images/curved6.jpg')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
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

</main>
<?php include_once '_footer.php'; ?>