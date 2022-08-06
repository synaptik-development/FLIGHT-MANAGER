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
    try {
        //si une action est demandé on l'éxécute
        if (isset($_GET['action']) && $_GET['action'] !== '') {

            // voir le profil
            if ($_GET['action'] === 'user') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $userId = $_GET['id'];

                    (new User())->execute($userId);
                } else {
                    throw new Exception('Aucun utilisateur sélectionné');
                }
            }

            // modifier le mot de passe
            elseif ($_GET['action'] === 'updatePassword') {
                if (isset($_GET['userId']) && $_GET['userId'] > 0) {
                    $userId = $_GET['userId'];
                    // si le formulaire est soumis on définit le point d'entrée
                    $input = null;
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $input = $_POST;
                    }

                    (new UpdatePassword())->execute($input, $userId);
                } else {
                    throw new Exception('Aucun utilisateur sélectionné');
                }
            }
        }

        // si aucune action n'est demandé on retourne à la page d'accueil
        else {
            (new Homepage())->execute($_SESSION['userId']);
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();

        require('templates/error.php');
    }
}

/*
    si aucune session n'est ouverte
    nouvelle page de connexion
    */ else {
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
