<?php

declare(strict_types=1);

namespace App\Controllers\Management;

require_once('src/lib/database.php');
require_once('src/model/flights.php');
require_once('src/model/users.php');
require_once('src/model/planes.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Flights\FlightsRepository;
use App\Model\Users\UsersRepository;
use App\Model\Planes\PlanesRepository;

class Management
{
    public function execute(string $userId)
    {
        include_once('assets/utils.php');

        // récupération utilisateur connecté
        $usersRepository = new UsersRepository();
        $usersRepository->dbConnect = new DatabaseConnection();
        $user = $usersRepository->getUser($userId);

        // récupération des utilisateurs
        $users = $usersRepository->getAllUsers();

        // récupération des vols programmés par l'utilisateur
        $flightsRepository = new FlightsRepository();
        $flightsRepository->dbConnect = new DatabaseConnection();
        $flights = $flightsRepository->getAllFlights();

        // vols du jours
        $todayFlights = array_filter($flights, 'checkEgality');
        // autres vols
        $otherFligths = array_filter($flights, 'checkInegality');

        // récupérations des modèles d'avions
        $planesRepository = new PlanesRepository();
        $planesRepository->dbConnect = new DatabaseConnection();
        $planes = $planesRepository->getAllPlanes();

        require('templates/management.php');
    }
}
