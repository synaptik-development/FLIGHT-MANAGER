<?php

declare(strict_types=1);

namespace App\Model\Flights;

require_once('src/lib/database.php');

use App\Lib\Database\DatabaseConnection;
use DateTime;

class Flight
{
    public string $flightId;
    public string $userId;
    public string $planeId;
    public string $departure;
    public string $date;
    public string $arrival;
    public string $duration;
    public string $price;
}

class FlightsRepository
{
    public DatabaseConnection $dbConnect;

    // rechercher tous les vols
    public function getAllFlights(): array
    {
        $statement = $this->dbConnect->getConnection()->query(
            "SELECT * FROM flights ORDER BY departure DESC"
        );

        $flights = [];
        while ($row = $statement->fetch()) {
            $flight = new Flight();
            $flight->flightId = $row['id'];
            $flight->userId = $row['user_id'];
            $flight->planeId = $row['plane_id'];
            $flight->date = date_format(new DateTime($row['departure']), 'd-m-Y');
            $flight->departure = date_format(new DateTime($row['departure']), 'H:i');
            $flight->arrival = date_format(new DateTime($row['arrival']), 'H:i');
            $flight->price = $row['price'];
            $flights[] = $flight;
        }
        return $flights;
    }

    // rechercher tous les vols d'un pilote
    public function getUserFlights(string $userId): array
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "SELECT * FROM flights WHERE user_id = ? ORDER BY departure DESC"
        );
        $statement->execute([$userId]);

        $flights = [];
        while ($row = $statement->fetch()) {
            $flight = new Flight();
            $flight->flightId = $row['id'];
            $flight->userId = $row['user_id'];
            $flight->planeId = $row['plane_id'];
            $flight->date = date_format(new DateTime($row['departure']), 'd-m-Y');
            $flight->departure = date_format(new DateTime($row['departure']), 'H:i');
            $flight->arrival = date_format(new DateTime($row['arrival']), 'H:i');
            $flight->price = $row['price'];
            $flights[] = $flight;
        }
        return $flights;
    }

    // rechercher un vol par son id
    public function getFlight(string $flightId): ?Flight
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "SELECT * FROM flights WHERE id = ?"
        );
        $statement->execute([$flightId]);
        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        $flight = new Flight();
        $flight->flightId = $row['id'];
        $flight->userId = $row['user_id'];
        $flight->planeId = $row['plane_id'];
        $flight->date = date_format(new DateTime($row['departure']), 'd-m-Y');
        $flight->departure = date_format(new DateTime($row['departure']), 'H:i');
        $flight->arrival = date_format(new DateTime($row['arrival']), 'H:i');
        $flight->price = $row['price'];

        return $flight;
    }

    // planifier un vol
    public function createFlight(string $userId, string $planeId, DateTime $departure, DateTime $arrival, string $duration, float $price)
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "INSERT INTO flights(user_id, plane_id, departure, arrival, duration, price) VALUES(?, ?, ?, ?, ?, ?)"
        );
        $success = $statement->execute([$userId, $planeId, $departure, $arrival, $duration, $price]);

        return ($success > 0);
    }

    // annuler un vol
    public function deleteFlight(string $flightId)
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "DELETE * FROM flights WHERE id = ?"
        );
        $success = $statement->execute([$flightId]);

        return ($success > 0);
    }
}