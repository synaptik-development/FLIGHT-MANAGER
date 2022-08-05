<?php

declare(strict_types=1);

namespace App\Controllers\Users\User;

require_once('src/lib/database.php');
require_once('src/model/users.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Users\UsersRepository;

class User
{
    public function execute(string $userId)
    {
        $userRepository = new UsersRepository();
        $userRepository->dbConnect = new DatabaseConnection();
        $user = $userRepository->getUser($userId);

        require('templates/user.php');
    }
}
