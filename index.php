<?php

declare(strict_types=1);
session_start();

require_once('src/controllers/login.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/users/user.php');
require_once('src/controllers/users/updatePassword.php');

use App\Controllers\Login\Login;
use App\Controllers\Homepage\Homepage;
use App\Controllers\Users\User\User;
use App\Controllers\Users\UpdatePassword\UpdatePassword;

/*
si une session utilisateur est ouverte
implémentation du router
*/

if (isset($_SESSION["userId"]) && !empty($_SESSION["userId"])) {
    $userId = $_SESSION['userId'];
    try {
        if (isset($_GET['action']) && $_GET['action'] !== '') {
            // voir profil
            if ($_GET['action'] === 'user') {
                if (isset($_GET['userId']) && $_GET['userId'] > 0) {
                    $userId = $_GET['userId'];
                    (new User())->execute($userId);
                } else {
                    throw new Exception('Aucun utilisateur sélectionné.');
                }
            }

            // modifier le mot de passe
            elseif ($_GET['action'] === 'updatePassword') {
                if (
                    isset($_GET['userId']) && $_GET['userId'] > 0
                ) {
                    $userId = $_GET['userId'];
                    (new UpdatePassword())->execute($_POST);
                } else {
                    throw new Exception('Aucun utilisateur sélectionné.');
                }
            }
        }

        // retour à la page d'accueil
        else {
            (new Homepage())->execute($userId);
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();

        require('templates/error.php');
    }
} else {
    /*
    si aucune session n'est ouverte
    nouvelle page de connexion
    */
    include_once('templates/login.php');
    try {
        if (
            isset($_GET['action']) && $_GET['action'] !== ''
        ) {
            if ($_GET['action'] === 'login') {
                (new Login())->execute($_POST);
            }
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();

        require('templates/error.php');
    }
}