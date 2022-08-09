<?php $title = "FLIGHT-MANAGER accueil"; ?>

<?php ob_start(); ?>

<!-- affichage du tableau de bord -->
<div class="management">
    <header class="header header--connected">
        <div class="header_username">
            <?= $user->lastname . ' ' . $user->firstname; ?><br>
            <a class="text-link" href="index.php?action=user&id=<?= urlencode($user->id) ?>">voir profil</a>
        </div>

        <div class="header_title">
            <img src="images/logo.png" alt="logo flight-manager">
            <h1>FLIGHT-MANAGER</h1>
        </div>

        <div class="header_user-info">
            <span><?= date_format($today, 'd-m-Y'); ?></span>
        </div>
    </header>

    <?php if ($user->isManager == 1) : ?>
    <main class="management_main">
        <div class="users-list card">
            <h3>utilisateurs inscrits</h3>
            <?php if (isset($users) & !empty($users)) : ?>
            <?php
                    foreach ($users as $user) {
                    ?>
            <a class="text-link" href="index.php?action=user&id=<?= urlencode($user->id) ?>">
                <?= $user->lastname . ' ' . $user->firstname ?>
            </a>
            <?php
                    }
                    ?>
            <?php else : ?>
            <p>Aucun utilisateur enregistré</p>
            <?php endif; ?>
        </div>

        <div class="planes-list card">
            <h3>liste des appareils</h3>
            <?php if (isset($planes) & !empty($planes)) : ?>
            <?php
                    foreach ($planes as $plane) {
                    ?>
            <a class="text-link" href="index.php?action=plane&id=<?= urlencode($plane->id) ?>">
                <?= $plane->registration ?>
            </a>
            <?php
                    }
                    ?>
            <?php else : ?>
            <p>Aucun avion enregistré</p>
            <?php endif; ?>
        </div>

        <div class="todays_flights-list card">
            <h3>vols du jour</h3>
            <?php if (isset($todayFlights) & !empty($todayFlights)) : ?>
            <?php
                    foreach ($todayFlights as $flight) {
                    ?>
            <div class="event-item">
                <a class="text-link" href="index.php?action=flight&id=<?= $flight->id; ?>">
                    n° de vol : <?= $flight->id; ?><br>
                    date : <?= date_format($flight->departure, 'd-m-Y'); ?><br>
                    <?php
                                foreach ($planes as $plane) {
                                ?>
                    <?php if ($plane->id === $flight->planeId) : ?>
                    appareil : <?= $plane->registration; ?><br>
                    <?php endif; ?>
                    <?php
                                }
                                ?>
                    <?php
                                foreach ($users as $user) {
                                ?>
                    <?php if ($user->id === $flight->userId) : ?>
                    pilote : <?= $user->lastname . ' ' . $user->firstname ?><br>
                    <?php endif; ?>
                    <?php
                                }
                                ?>
                </a>
            </div>
            <?php
                    }
                    ?>
            <?php else : ?>
            <p>Aucun vol programmé</p>
            <?php endif; ?>
        </div>

        <div class="other_flights-list card">
            <h3>prochainement</h3>
            <?php if (isset($otherFligths) & !empty($otherFligths)) : ?>
            <?php
                    foreach ($otherFligths as $flight) {
                    ?>
            <div class="event-item">
                <a class="text-link" href="index.php?action=flight&id=<?= $flight->id; ?>">
                    n° de vol : <?= $flight->id; ?><br>
                    date : <?= date_format($flight->departure, 'd-m-Y'); ?><br>
                    <?php
                                foreach ($planes as $plane) {
                                ?>
                    <?php if ($plane->id == $flight->id) : ?>
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
    </main>

    <?php else : ?>
    <div class="alert">Accés non autorisé.</div>
    <?php endif; ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>