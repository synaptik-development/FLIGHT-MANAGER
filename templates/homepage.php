<?php $title = "FLIGHT-MANAGER accueil"; ?>

<?php ob_start(); ?>

<!-- affichage du tableau de bord -->
<div class="homepage">
    <header class="header header--connected">
        <div class="header_username">
            <?= $user->lastname . ' ' . $user->firstname; ?><br>
            <a href="index.php?action=user&userId=<?= urlencode($user->userId) ?>">voir profil</a>
        </div>

        <div class="header_title">
            <img src="images/logo.png" alt="logo flight-manager">
            <h1>FLIGHT-MANAGER</h1>
        </div>

        <div class="header_user-info">
            <span><?= date_format($today, 'd-m-Y'); ?></span>
            <br>
            crédits : <strong><?= $user->credits . ' €'; ?></strong>
            <br>
            heures de vol : <strong><?= $user->timeCounter ?></strong>
        </div>
    </header>

    <main class="homepage_main">
        <div class="homepage_main_calendar">
            <?php if ($user->isPilot == 1) : ?>
            <div class="homepage_main_calendar_calendar">
                <!-- calendrier ici -->
            </div>

            <div class="homepage_main_calendar_link">
                <div class="btn">programmer un vol</div>
            </div>
            <?php else : ?>
            <div class="alert">Impossible de planifier un vol. Vous n'êtes pas inscrit en tant que pilote.</div>
            <?php endif; ?>
        </div>

        <div class="homepage_main_events">
            <div class="homepage_main_events_items">
                <h3>Aujourd'hui</h3>
                <?php if (isset($todayFlights) & !empty($todayFlights)) : ?>
                <?php
                    foreach ($todayFlights as $flight) {
                    ?>
                <div class="event-item">
                    <a href="#">
                        n° de vol : <?= $flight->flightId; ?><br>
                        <?php
                                foreach ($planes as $plane) {
                                ?>
                        <?php if ($plane->planeId == $flight->planeId) : ?>
                        appareil : <?= $plane->registration; ?><br>
                        <?php endif; ?>
                        <?php
                                }
                                ?>
                        départ : <?= date_format($flight->departure, 'h:m') . ' h'; ?><br>
                        arrivée : <?= date_format($flight->arrival, 'h:m') . ' h'; ?>
                    </a>
                </div>
                <?php
                    }
                    ?>
                <?php else : ?>
                <p>Aucun vol programmé</p>
                <?php endif; ?>
            </div>

            <div class="homepage_main_events_items">
                <h3>Prochainement</h3>
                <?php if (isset($otherFligths) & !empty($otherFligths)) : ?>
                <?php
                    foreach ($otherFligths as $flight) {
                    ?>
                <div class="event-item">
                    <a href="#">
                        n° de vol : <?= $flight->flightId; ?><br>
                        date : <?= date_format($flight->departure, 'd-m-Y'); ?><br>
                        <?php
                                foreach ($planes as $plane) {
                                ?>
                        <?php if ($plane->planeId == $flight->planeId) : ?>
                        appareil : <?= $plane->registration; ?><br>
                        <?php endif; ?>
                        <?php
                                }
                                ?>
                        départ : <?= date_format($flight->departure, 'H:i') . ' h'; ?><br>
                        arrivée : <?= date_format($flight->arrival, 'H:i') . ' h'; ?>
                    </a>
                </div>
                <?php
                    }
                    ?>
                <?php else : ?>
                <p>Aucun vol programmé</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="wheather">
            <!-- météo ici -->
        </div>
    </main>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>