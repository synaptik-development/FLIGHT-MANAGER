<?php $title = "FLIGHT-MANAGER vol info"; ?>

<?php ob_start(); ?>

<!-- affichage des infos utilisateur -->
<div class="flight">
    <header class="header">
        <img src="images/logo.png" alt="logo flight-manager">
        <h1>FLIGHT-MANAGER</h1>
        <a class="dashboard-link text-link" href="index.php">tableau de bord</a>
    </header>

    <main class="flight_main">
        <?php if ($flight->userId === $_SESSION['userId'] || $user->isManager == 1) : ?>
        <h2>VOL N°<?= $flight->id ?></h2>

        <div class="card">
            <div>
                <h3>infos vol</h3>

                <p>
                    Date :
                    <span><?= date_format($flight->departure, 'd-m-Y'); ?></span>
                </p>

                <p>
                    Heure de départ :
                    <span><?= date_format($flight->departure, 'h:m'); ?></span>
                </p>

                <p>
                    Heure de retour :
                    <span><?= date_format($flight->arrival, 'h:m'); ?></span>
                </p>

                <p>
                    Durée de vol :
                    <span><?= $flight->duration . ' H'; ?></span>
                </p>

                <p>
                    Prix :
                    <span><?= $flight->price . ' €'; ?></span>
                </p>
            </div>

            <div>
                <h3>infos avion</h3>

                <p>
                    Immatriculation de l'avion :
                    <span><?= $plane->registration ?></span>
                </p>

                <p>
                    modèle :
                    <span><?= $plane->model ?></span>
                </p>

                <p>
                    Heures de vol :
                    <span><?= $plane->timeCounter ?></span>
                </p>
            </div>

            <div>
                <h3>infos pilote</h3>
                <p>
                    Nom :
                    <span><?= $user->lastname ?></span>
                </p>

                <p>
                    Prénom :
                    <span><?= $user->firstname ?></span>
                </p>
            </div>

            <!-- <form action="index.php?action=deleteFlight&flightId=<?= $flight->id ?>"> -->
            <button id="reveal_confirm_deleteFlight" class="btn btn--alert">Annuler vol</button>
            <!-- </form> -->
        </div>

        <div id="confirm_deleteFlight" class="fixed-window hidden">
            <h4>annuler le vol <?= $flight->id . ' du ' . date_format($flight->departure, 'd-m-Y') ?></h4>
            <div>
                <button class="btn cancel">non</button>
                <a href="index.php?action=deleteFlight&flightId=<?= $flight->id ?>" class="btn btn--alert">oui</a>
            </div>
        </div>
        <?php else : ?>
        <p>Accés non autorisé</p>
        <a href="index.php">Retour à l'accueil</a>
        <?php endif; ?>
    </main>

    <?php $content = ob_get_clean(); ?>

    <?php require('layout.php'); ?>