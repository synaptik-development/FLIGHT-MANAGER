<?php

declare(strict_types=1);

namespace App\Controllers\Flights\DeleteFlight;

require_once('src/lib/database.php');
require_once('src/model/users.php');
require_once('src/model/planes.php');
require_once('src/model/flights.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Users\UsersRepository;
use App\Model\Flights\FlightsRepository;
use App\Model\Planes\PlanesRepository;

class DeleteFlight
{
    public function execute(string $flightId)
    {
        // infos sur le pilote du vol
        $usersRepository = new UsersRepository();
        $usersRepository->dbConnect = new DatabaseConnection();
        $user = $usersRepository->getUser($_SESSION['userId']);

        // infos sur le vol
        $flightsRepository = new FlightsRepository;
        $flightsRepository->dbConnect = new DatabaseConnection();
        $flight = $flightsRepository->getFlight($flightId);

        if ($flight->userId === $_SESSION['userId'] || $user->isManager == 1) {
            $success = $flightsRepository->deleteFlight($flightId);
            if (!$success) {
                throw new \Exception('Impossible d\'annuler le vol');
            } else {

                $updateCredits = $usersRepository->removeCredits($flight->price, $_SESSION['userId']);
                $updateUserCounter = $usersRepository->removetimeCounter($flight->duration, $_SESSION['userId']);
                $planeRepository = new PlanesRepository();
                $planeRepository->dbConnect = new DatabaseConnection();
                $updatePlaneCounter = $planeRepository->removetimeCounter($flight->duration, $flight->planeId);

                if (!$updateUserCounter) {
                    throw new \Exception('Impossible de mettre à jour le compteur d\'heures du pilote');
                } elseif (!$updateCredits) {
                    throw new \Exception('Impossible de mettre à jour le portefeuille du pilote');
                } elseif (!$updatePlaneCounter) {
                    throw new \Exception('Impossible de mettre à jour le compteur de l\'appareil');
                } else {
                    header('location: index.php');
                }
            }
        } else {
            throw new \Exception('Opération non autorisée');
        }

        require('templates/flight.php');
    }
}