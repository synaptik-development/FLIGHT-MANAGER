<?php

declare(strict_types=1);
session_start();

require_once('src/controllers/users/login.php');
require_once('src/controllers/homepage.php');

use App\Controllers\Users\Login\Login;
use App\Controllers\Homepage\Homepage;

// si une session utilisateur est ouverte
if (isset($_SESSION["userId"])) {
    $userId = $_SESSION['userId'];
    /*
    implémentation du router
    */
    try {
        if (isset($_GET['action']) && $_GET['action'] !== '') {
            // if ($_GET['action'] === 'login') {
            //     (new Login())->execute($_POST);
            // }
        } else {
            (new Homepage())->execute($userId);
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();

        require('templates/error.php');
    }
} else {
    /*
    si aucune session n'est ouverte
    implémentation de la connection de l'utilisateur
    */
    include_once('templates/login.php');
    try {
        if (isset($_GET['action']) && $_GET['action'] !== '') {
            if ($_GET['action'] === 'login') {
                (new Login())->execute($_POST);
            }
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();

        require('templates/error.php');
    }
}
