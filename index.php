<?php

declare(strict_types=1);
session_start();

require_once('src/controllers/login.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/users/user.php');
require_once('src/controllers/users/updatePassword.php');
require_once('src/controllers/flights/flight.php');
require_once('src/controllers/flights/delete.php');
require_once('src/controllers/flights/add.php');
require_once('src/controllers/management.php');

use App\Controllers\Login\Login;
use App\Controllers\Homepage\Homepage;
use App\Controllers\Users\User\User;
use App\Controllers\Users\UpdatePassword\UpdatePassword;
use App\Controllers\Flights\Flight\Flight;
use App\Controllers\Flights\DeleteFlight\DeleteFlight;
use App\Controllers\Flights\Add\AddFlight;
use App\Controllers\Management\Management;

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

            // voir un vol
            elseif ($_GET['action'] === 'flight') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $flightId = $_GET['id'];

                    (new Flight())->execute($flightId);
                } else {
                    throw new Exception('Aucun vol sélectionné');
                }
            }

            // annuler un vol
            elseif ($_GET['action'] === 'deleteFlight') {
                if (isset($_GET['flightId']) && $_GET['flightId'] > 0) {
                    $flightId = $_GET['flightId'];

                    (new DeleteFlight())->execute($flightId);
                } else {
                    throw new Exception('Aucun vol sélectionné');
                }
            }

            // planifier un vol
            elseif ($_GET['action'] === 'addFlight') {
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                    (new AddFlight)->execute($input);
                }
            }

            // ouvrir une page de management
            elseif ($_GET['action'] === 'management') {
                (new Management())->execute($_SESSION['userId']);
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