<?php

declare(strict_types=1);

namespace App\Controllers\Users\Register;

require_once('src/lib/database.php');
require_once('src/model/users.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Users\UsersRepository;

class Register
{
    public function execute()
    {
        include_once('assets/utils.php');

        // vérification champs vides
        if (
            !empty($_POST['firsname'])
            || !empty($_POST['lastname'])
            || empty($_POST['email'])
            || !empty($_POST['password'])
            || !empty($_POST['pilot'])
            || !empty($_POST['instructor'])
        ) {
            // vérification validité email
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Adresse email invalide');
            } else {
                $password = htmlspecialchars(crypt($_POST['password'], $hash));
                $email = htmlspecialchars($_POST['email']);
                $firstname = htmlspecialchars($_POST['firstname']);
                $lastname = htmlspecialchars($_POST['lastname']);
                $instructor = htmlspecialchars($_POST['instructor']);
                $pilot = htmlspecialchars($_POST['pilot']);
            }
        } else {
            throw new \Exception('Tous les champs sont obligatoires.');
        }

        // insertion dans la base de données
        $usersRepository = new UsersRepository;
        $usersRepository->dbConnect = new DatabaseConnection;
        $success = $usersRepository->createUser(
            $firstname,
            $lastname,
            $email,
            $password,
            $pilot,
            $instructor
        );
        if (!$success) {
            throw new \Exception('Un problème est survenu.');
        } else {
            return 'utilisateur créé avec succés.';
        }
    }
}
