<?php

declare(strict_types=1);

namespace App\Controllers\Users\UpdatePassword;

require_once('src/lib/database.php');
require_once('src/model/users.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Users\UsersRepository;

class UpdatePassword
{
    public function execute(array $input)
    {
        include_once('assets/utils.php');

        //vérification champs vides
        if (!empty($input['password'])) {
            $password = htmlspecialchars($input['password']);
        } else {
            throw new \Exception('Veuillez saisir votre ancien mot de passe.');
        }

        if (!empty($input['new-password'])) {
            $newPassword = htmlspecialchars($input['new-password']);
        } else {
            throw new \Exception('Veuillez saisir un nouveau mot de passe.');
        }

        if (!empty($input['confirm-password'])) {
            $confirmPassword = htmlspecialchars($input['confirm-password']);
        } else {
            throw new \Exception('Veuillez confirmer le mot de passe.');
        }

        // vérification de l'email
        $usersRepository = new UsersRepository;
        $usersRepository->dbConnect = new DatabaseConnection;
        $user = $usersRepository->getUser($_SESSION['userId']);
        if (!$user) {
            throw new \Exception('Utilisateur introuvable.');
        } else {
            if (crypt($password, $hash) !== $user->password) {
                throw new \Exception('Mot de passe incorrect.');
            } elseif ($newPassword !== $confirmPassword) {
                throw new \Exception('Les mots de passes saisis ne sont pas identiques.');
            } else {
                $success = $usersRepository->updatePassword($user->userId, $newPassword);
                if (!$success) {
                    throw new \Exception('Impossible de modifier le mot de passe');
                } else {
                    header('location: index.php?action=user&userId=' . $user->userId);
                }
            }
        }
    }
}