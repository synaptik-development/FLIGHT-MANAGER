<?php

declare(strict_types=1);

namespace App\Controllers\Login;

require_once('src/lib/database.php');
require_once('src/model/users.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Users\UsersRepository;

class Login
{

    public function execute(array $input)
    {
        include_once('assets/utils.php');

        //vérification champs vides
        if (!empty($input['email']) && !empty($input['password'])) {
            $password = htmlspecialchars($input['password']);
            $email = htmlspecialchars($input['email']);
        } else {
            throw new \Exception('Tous les champs sont obligatoires.');
        }

        // vérification de l'email
        $usersRepository = new UsersRepository;
        $usersRepository->dbConnect = new DatabaseConnection;
        $success = $usersRepository->getUserByEmail($email);
        if (!$success) {
            throw new \Exception('Adresse mail invalide.');
        } else {
            if (crypt($password, $hash) !== $success->password) {
                throw new \Exception('Mot de passe incorrect.');
            } else {
                $_SESSION['userId'] = $success->id;
                header('location: index.php');
            }
        }
    }
}