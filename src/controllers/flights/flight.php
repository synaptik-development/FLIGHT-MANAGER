<?php

declare(strict_types=1);

namespace App\Controllers\Flights\Flight;

require_once('src/lib/database.php');
require_once('src/model/users.php');
require_once('src/model/planes.php');
require_once('src/model/flights.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Users\UsersRepository;
use App\Model\Flights\FlightsRepository;
use App\Model\Planes\PlanesRepository;

class Flight
{
    public function execute(string $flightId)
    {
        // infos sur le vol
        $flightsRepository = new FlightsRepository;
        $flightsRepository->dbConnect = new DatabaseConnection();
        $flight = $flightsRepository->getFlight($flightId);

        // infos sur le pilote du vol
        $usersRepository = new UsersRepository();
        $usersRepository->dbConnect = new DatabaseConnection();
        $user = $usersRepository->getUser($flight->userId);

        // infos sur l'avion
        $planesRepository = new PlanesRepository();
        $planesRepository->dbConnect = new DatabaseConnection();
        $plane = $planesRepository->getPlane($flight->planeId);

        require('templates/flight.php');
    }
}
