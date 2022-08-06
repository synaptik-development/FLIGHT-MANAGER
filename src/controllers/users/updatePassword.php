<?php

declare(strict_types=1);

namespace App\Controllers\Users\UpdatePassword;

require_once('src/lib/database.php');
require_once('src/model/users.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Users\UsersRepository;

class UpdatePassword
{
    public function execute(?array $input, string $userId)
    {
        include_once('assets/utils.php');

        // soumission du formulaire en cas de saisie par l'utilisateur
        if ($input !== null) {
            $password = null;
            $newPassword = null;
            $confirmPassword = null;

            // contrôle des champs vides
            if (!empty($input['password']) && !empty($input['new-password']) && !empty($input['confirm-password'])) {
                $password = crypt(htmlspecialchars($input['password']), $hash);
                $newPassword = crypt(htmlspecialchars($input['new-password']), $hash);
                $confirmPassword = crypt(htmlspecialchars($input['confirm-password']), $hash);
            } else {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            // contrôle des droits de l'utilisateur
            $usersRepository = new UsersRepository();
            $usersRepository->dbConnect = new DatabaseConnection();
            $user = $usersRepository->getUser($userId);

            // contrôle mot de passe
            if ($password !== $user->password) {
                throw new \Exception('Le mot de passe est incorrect');
            }

            // contrôle validité de la confirmation du mot de passe
            if ($confirmPassword !== $newPassword) {
                throw new \Exception('Veuillez saisir deux mots de passe identiques');
            }

            // enregistement dans la base de données
            $usersRepository = new UsersRepository();
            $usersRepository->dbConnect = new DatabaseConnection();
            $success = $usersRepository->updatePassword($userId, $newPassword);

            if (!$success) {
                throw new \Exception('impossible de modifier le mot de passe');
            } else {
                header('Location: index.php?action=user&id=' . $userId);
            }
        }

        // renvois de l'utilisateur modifié
        $usersRepository = new UsersRepository();
        $usersRepository->dbConnect = new DatabaseConnection();
        $user = $usersRepository->getUser($userId);
        if ($user === null) {
            throw new \Exception("L\'utilisateur $user est introuvable.");
        }

        require('templates/update_password.php');
    }
}