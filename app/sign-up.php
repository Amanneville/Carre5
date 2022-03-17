<?php
require '_head.php';

# ------------------------------------- #
## PAGE INSCRIPTION NEW USER ##
# ------------------------------------ #

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
    if ('checkConditions' == $_GET['error']) {
        $type = 'danger';
        $message = 'Vous devez accepter les conditions !';
    }
    if ('userNameInvalid' == $_GET['error']) {
        $type = 'warning';
        $message = 'Votre nom d\'utilisateur doit comporter entre 3 et 20 caractères.';
    }
    if ('passwordInvalid' == $_GET['error']) {
        $type = 'warning';
        $message = 'Votre mot de passe doit comporter entre 4 et 30 caractères.';
    }
    if ('userExist' == $_GET['error']) {
        $type = 'danger';
        $message = 'Ce nom d\'utilisateur existe déjà !';
    }
    if ('passwordNotIdem' == $_GET['error']) {
        $type = 'danger';
        $message = 'Vos mots de passe ne correspondent pas !';
    }
}
?>

<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Bienvenue !</h1>
                    <p class="text-lead text-white">Utilisez ce formulaire pour vous connecter ou créer un nouveau compte gratuitement.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Inscrivez-vous ici</h5>
                        <!-- <#?php echo $alert ? "<div class='alert alert-{$type} mt-2'>{$message}</div>" : ''; ?> -->
                    </div>

                    <div class="card-body">
                        <form role="form text-left" action="signUp_post.php" method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="email-addon" name="username">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Re-type your password" aria-label="Confirm password" aria-describedby="password-addon" name="password2">
                            </div>
                            <div class="form-check form-check-info text-left">
                                <input class="form-check-input" type="checkbox" name="valueOk" value="" id="flexCheckDefault" checked="">
                                <label class="form-check-label" for="flexCheckDefault">
                                    J'accepte les <a href="javascript:;" class="text-dark font-weight-bolder">Termes
                                        et Conditions</a>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">S'inscrire</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Vous avez déjà un compte ? <a href="sign-in.php" class="text-dark font-weight-bolder">S'identifier</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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