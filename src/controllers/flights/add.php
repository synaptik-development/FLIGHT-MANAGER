<?php

declare(strict_types=1);

namespace App\Controllers\Flights\Add;

require_once('src/lib/database.php');
require_once('src/model/flights.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Flights\FlightsRepository;

class AddFlight
{
    public string $errorMessage;

    public function execute()
    {
        if (!isset($_SESSION["connectedUser"])) {
            $errorMessage = "Vous devez être connecté pour planifier un vol";
        }
    }
}
