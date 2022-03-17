<?php

declare(strict_types=1);
require 'includes/config.php';


# ---------------------------------------------------- #
## VALIDATION & CONNECTION SESSION USER ##
# ---------------------------------------------------- #

// vérif champs NON vides //
if (empty($_POST['username']) || empty($_POST['password'])) {
    // echo '<br>' . "Tous les champs du formulaire doivent être remplis !"
    // . '<br>'.'<a href="sign-in.php">' ."Retour à la connexion".'</a>';
    header('Location: sign-in.php?error=missingInputSign');
    exit();
    // si tout ok = initialisation des variables + assainir 
} else {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
    // echo '<br>' . "Tous les champs sont bien remplis !";
}

# -------------------------------------- #
## REQUÊTE = RÉCUP. NAME USER ##
# -------------------------------------- #
try {
    $user_connect_verif = 'SELECT * FROM user WHERE username = :username LIMIT 1';
    $req_verif_user = $db->prepare($user_connect_verif);
    $req_verif_user->bindValue(':username', $username, PDO::PARAM_STR);
    $req_verif_user->execute();

    $user_connect = $req_verif_user->fetch();
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
if ($user_connect == null) {
    //    echo  '<br>' . 'Identifiant ou mot de passe incorrecte'
    //    . '<br>'.'<a href="sign-in.php">' ."Retour à la connexion".'</a>';
    header('Location: sign-in.php?error=invalidInputSign');
    exit();
} elseif (!password_verify($password,  $user_connect['password'])) {
    // echo  '<br>' . 'Identifiant ou mot de passe incorrecte'
    // . '<br>'.'<a href="sign-in.php">' ."Retour à la connexion".'</a>';
    header('Location: sign-in.php?error=invalidInputSign');
    exit();
    // éléments de connexion user ++ créa tooken //

} else {
    $_SESSION['user'] = $user_connect['username'];
    $_SESSION['token'] = md5(uniqid('csrf', true));
    $_SESSION['id'] = $user['users_id'];
    // echo  '<br>' . 'Connection OK';
    header('location:index.php');
}
