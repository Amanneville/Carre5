<?php
require 'includes/db.php';
session_start();


# ---------------------------- #
## DÉCONNECTION USER ##
# ---------------------------- #

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location:index.php');
}

if (empty($_SESSION)) {
    if (isset($username)) {
        header('Location:sign-in.php');
        exit();
    }
    $username = null;
} else {
    $username = $_SESSION['user'];
}

