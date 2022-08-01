<?php

declare(strict_types=1);

namespace App\Model\Planes;

require_once('src/lib/database.php');

use App\Lib\Database\DatabaseConnection;
use DateTime;

class Plane
{
    public string $planeId;
    public string $registration;
    public string $model;
    public string $purchaseDate;
    public string $places;
    public string $timeCounter;
    public string $hourPrice;
}

class PlanesRepository
{
    public DatabaseConnection $dbConnect;

    // rechercher tous les appareils
    public function getAllPlanes(): array
    {
        $statement = $this->dbConnect->getConnection()->query(
            "SELECT * FROM planes ORDER BY registration ASC"
        );

        $planes = [];
        while ($row = $statement->fetch()) {
            $plane = new Plane();
            $plane->planeId = $row['id'];
            $plane->registration = $row['registration'];
            $plane->model = $row['model'];
            $plane->purchaseDate = date_format(new DateTime($row['purchase_date']), 'd-m-Y');
            $plane->places = $row['places'];
            $plane->timeCounter = $row['time_counter'];
            $plane->hourPrice = $row['hour_price'];
            $planes[] = $plane;
        }
        return $planes;
    }

    // rechercher un appareil par son id
    public function getPlane(string $planeId): ?Plane
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "SELECT * FROM planes WHERE id = ?"
        );
        $statement->execute([$planeId]);
        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        $plane = new Plane();
        $plane->planeId = $row['id'];
        $plane->registration = $row['registration'];
        $plane->model = $row['model'];
        $plane->purchaseDate = date_format(new DateTime($row['purchase_date']), 'd-m-Y');
        $plane->places = $row['places'];
        $plane->timeCounter = $row['time_counter'];
        $plane->hourPrice = $row['hour_price'];

        return $plane;
    }

    // créer un nouvel appareil
    public function createPlane(string $registration, string $model, DateTime $purchaseDate, string $places, string $timeCounter, float $hourPrice)
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "INSERT INTO planes(registration, model, purchase_date, places, time_counter, hour_price) VALUES(?, ?, ?, ?, ?, ?)"
        );
        $success = $statement->execute([$registration, $model, $purchaseDate, $places, $timeCounter, $hourPrice]);

        return ($success > 0);
    }

    // supprimer un appareil de la base de données
    public function deletePlane(string $planeId): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "DELETE * FROM planes WHERE id = ?"
        );
        $success = $statement->execute([$planeId]);

        return ($success > 0);
    }

    // ajouter du temps de vol
    public function addtimeCounter(string $counter, string $planeId): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "UPDATE planes SET time_counter = time_counter + ? WHERE id = ?"
        );
        $success = $statement->execute([$counter, $planeId]);

        return ($success > 0);
    }

    // retirer du temps de vol
    public function removetimeCounter(string $counter, string $planeId): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "UPDATE planes SET time_counter = time_counter - ? WHERE id = ?"
        );
        $success = $statement->execute([$counter, $planeId]);

        return ($success > 0);
    }

    // changer la date de la dernière révision
    public function updateLatestRevision(DateTime $revisionDate, string $planeId): bool
    {
        $statement = $this->dbConnect->getConnection()->prepare(
            "UPDATE planes SET latest_revision = ? WHERE id = ?"
        );
        $success = $statement->execute([$revisionDate, $planeId]);

        return ($success > 0);
    }
}
