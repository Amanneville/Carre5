<?php

declare(strict_types=1);
require 'includes/config.php';

# Vérif. champs envoyés par user / Test rapide #
/*
* if(in_array('', $_POST)){
*    echo 'pas ok';
* }
* => OK
*/

# ----------------------------------------------------------------------------#
##  RÉCEPTION & VALIDATION DES DONNÉES D'INSCRIPTION USER  ##
# ----------------------------------------------------------------------------#

# ---------------------------------- #
##  RÉCEPTION DES DONNÉES   ##
# ---------------------------------- #

// vérif champs NON vides //
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2'])) {
    // echo '<br>' . "Tous les champs du formulaire doivent être remplis !"
    // . '<br>'.'<a href="sign-up.php">' ."Retour à l'inscription".'</a>';
    // echo 'Missing input';
    header('Location: sign-up.php?error=missingInput');
    exit();
}

// vérif case "conditions" cochée //
if (!isset($_POST['valueOk'])) {
    // echo '<br>' . "Vous devez accepter les conditions !"
    // . '<br>'.'<a href="sign-up.php">' ."Retour à l'inscription".'</a>';
    header('Location: sign-up.php?error=checkConditions');
    exit();
    // si tout ok = initialisation des variables + assainir 
} else {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_POST['password2']));
}

# ----------------------------------- #
##  VALIDATION DES DONNÉES   ##
# ----------------------------------- #

// vérif username > 2 & < 20 caractères + idem principe password //
if (strlen($username) < 3 || strlen($username) > 20) {
    header('Location: sign-up.php?error=userNameInvalid');
    exit();
}
if (strlen($password) < 4 || strlen($password) > 30) {
    header('Location: sign-up.php?error=passwordInvalid');
    exit();
}

// vérif username unique //
try {
    $bdd_verif = 'SELECT COUNT(*) FROM user WHERE username = :username';

    $req_verif = $db->prepare($bdd_verif);
    $req_verif->bindvalue(':username', $username, PDO::PARAM_STR);
    $req_verif->execute();

    $result_req = $req_verif->fetchColumn();
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
if ($result_req > 0) {
    // echo '<br>' . 'Ce nom d\'utilisateur existe déjà !'
    // . '<br>'.'<a href="sign-up.php">' ."Retour à l'inscription".'</a>';
    header('Location: sign-up.php?error=userExist');
    exit();
}

// vérif concordance des mots de passe //
if ($password !== $password2) {
    //     echo '<br>' . 'Vos mots de passe ne sont pas identiques !' 
    //    . '<br>'.'<a href="sign-up.php">' ."Retour à l'inscription".'</a>';
    header('Location: sign-up.php?error=passwordNotIdem');
    exit();
}

// crypter le mdp //
$password = password_hash($password, PASSWORD_DEFAULT);


# ---------------------------------------- #
##  si tout ok == AJOUT DANS BDD   ##
# ---------------------------------------- #

try {
    $bdd_insert = 'INSERT INTO user (username, password) VALUES (:username, :password)';

    $req_insert = $db->prepare($bdd_insert);
    $req_insert->bindValue(':username', $username, PDO::PARAM_STR);
    $req_insert->bindValue(':password', $password, PDO::PARAM_STR);

    $result_insert = $req_insert->execute();
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
if ($result_insert) {
    // echo '<br>' . 'Vous êtes bien inscrit !' 
    // . '<br>'.'<a href="sign-in.php">' ."Connectez-vous".'</a>';
    header('Location: index.php?success=signInok');
    exit();
} else {
    echo '<br>' . 'Une erreur est survenue...'
        . '<br>' . '<a href="sign-up.php">' . "Retour à l'inscription" . '</a>';
    exit();
}
