<?php $title = "FLIGHT-MANAGER accueil"; ?>

<?php ob_start() ?>
<div id="homepage-body">
    <header>
        <h1>FLIGHT-MANAGER</h1>
        <strong><?= $user->lastname . ' ' . $user->firstname; ?></strong>
        <div>
            <strong><?= date_format(new DateTime(), 'd-m-Y'); ?></strong>
            <p>crédits : <strong><?= $user->credits . ' €'; ?></strong></p>
            <p>heures de vol : <strong><?= $user->timeCounter ?></strong></p>
        </div>
    </header>


    <main>
        <div id="calandar"></div>

        <div id="events">
            <?php if (isset($flights) & !empty($flights)) : ?>
            <?php
                foreach ($flights as $flight) {
                ?>
            <div class="event">
                <a href="#">
                    n° de vol : <?= $flight->flightId; ?><br>
                    date : <?= $flight->date; ?><br>
                    <?php
                            foreach ($planes as $plane) {
                            ?>
                    <?php if ($plane->planeId == $flight->planeId) : ?>
                    appareil : <?= $plane->registration; ?><br>
                    <?php endif; ?>
                    <?php
                            }
                            ?>
                    départ : <?= $flight->departure . ' h'; ?><br>
                    arrivée : <?= $flight->arrival . ' h'; ?>
                </a>
            </div>
            <?php
                }
                ?>
            <?php else : ?>
            <p>Aucun vol programmé à ce jour</p>
            <?php endif; ?>

        </div>

        <div id="wheather"></div>
    </main>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>