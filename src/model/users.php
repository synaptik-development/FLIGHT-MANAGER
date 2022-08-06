<?php

declare(strict_types=1);

namespace App\Model\Users;

require_once('src/lib/database.php');

use App\Lib\Database\DatabaseConnection;
use DateTime;

class User
{
    public string $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $timeCounter;
    public string $credits;
    public DateTime $inscriptionDate;
    public string $isPilot;
    public string $isInstructor;
    public string $isManager;
}

class UsersRepository
{
    public DatabaseConnection $dbConnect;

    // rechercher tous les utilisateurs
    public function getAllUsers(): array
    {
        $statement = $this->dbConnect->getConnection()->query(
            "SELECT * from users ORDER BY lastname ASC"
        );

        $users = [];
        while ($row = $statement->fetch()) {
            $user = new User();
            $user->id = $row['id'];
            $user->firstname = $row['firstname'];
            $user->lastname = $row['lastname'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->timeCounter = $row['time_counter'];
            $user->credits = $row['credits'];
            $user->inscriptionDate = new DateTime($row['inscription_date']);
            $user->isPilot = $row['pilot'];
            $user->isInstructor = $row['instructor'];
            $user->isManager = $row['manager'];
            $users[] = $user;
        }
        return $users;
    }

    // rechercher un pilote par son id
    public function getUser(string $userId): ?User
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "SELECT * FROM users WHERE id = ?"
        );
        $statement->execute([$userId]);
        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        $user = new User();
        $user->id = $row['id'];
        $user->firstname = $row['firstname'];
        $user->lastname = $row['lastname'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->timeCounter = $row['time_counter'];
        $user->credits = $row['credits'];
        $user->inscriptionDate = new DateTime($row['inscription_date']);
        $user->isPilot = $row['pilot'];
        $user->isInstructor = $row['instructor'];
        $user->isManager = $row['manager'];

        return $user;
    }

    // rechercher un pilote par son email
    public function getUserByEmail(string $email): ?User
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "SELECT * FROM users WHERE email = ?"
        );
        $statement->execute([$email]);
        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        $user = new User();
        $user->id = $row['id'];
        $user->firstname = $row['firstname'];
        $user->lastname = $row['lastname'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->timeCounter = $row['time_counter'];
        $user->credits = $row['credits'];
        $user->inscriptionDate = new DateTime($row['inscription_date']);
        $user->isPilot = $row['pilot'];
        $user->isInstructor = $row['instructor'];
        $user->isManager = $row['manager'];

        return $user;
    }

    // créer un nouveau pilote
    public function createUser($firstname, $lastname, $email, $password, $isPilot, $isInstructor): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "INSERT INTO users(firstname, lastname, email, password, pilot, instructor, inscription) VALUES(?, ?, ?, ?, ?, ?, NOW())"
        );
        $success = $statement->execute([$firstname, $lastname, $email, $password, $isPilot, $isInstructor]);

        return ($success > 0);
    }

    // supprimer un pilote de la base de données
    public function deleteUser(string $userId): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "DELETE * FROM users WHERE id = ?"
        );
        $success = $statement->execute([$userId]);

        return ($success > 0);
    }

    // modifier le mot de passe
    public function updatePassword(string $userId, string $password): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "UPDATE users SET password = ? WHERE id = ?"
        );
        $success =  $statement->execute([$password, $userId]);

        return ($success > 0);
    }

    // créditer le compte
    public function addCredits(float $credits, string $userId): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "UPDATE users SET credits = credits + ? WHERE id = ?"
        );
        $success =  $statement->execute([$credits, $userId]);

        return ($success > 0);
    }

    // débiter le compte
    public function removeCredits(float $credits, string $userId): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "UPDATE users SET credits = credits - ? WHERE id = ?"
        );
        $success =  $statement->execute([$credits, $userId]);

        return ($success > 0);
    }

    // ajouter des heures de vol
    public function addtimeCounter(string $counter, string $userId): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "UPDATE users SET time_counter = time_counter + ? WHERE id = ?"
        );
        $success =  $statement->execute([$counter, $userId]);

        return ($success > 0);
    }

    // retirer des heures de vol
    public function removetimeCounter(string $counter, string $userId): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "UPDATE users SET time_counter = time_counter - ? WHERE id = ?"
        );
        $success =  $statement->execute([$counter, $userId]);

        return ($success > 0);
    }
}
