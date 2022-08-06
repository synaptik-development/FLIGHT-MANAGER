<?php $title = "FLIGHT-MANAGER"; ?>

<?php ob_start(); ?>

<?php if (isset($errorMessage) && !empty($errorMessage)) : ?>
    <div class="fixed-window">
        <p class="alert">Erreur : <?= $errorMessage ?></p>
    </div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>