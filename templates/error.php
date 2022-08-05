<?php $title = "FLIGHT-MANAGER"; ?>

<?php ob_start(); ?>
<?php if (isset($errorMessage) && !empty($errorMessage)) : ?>
<div id="error-message" class="fixed-window">
    <p class="message">Erreur : <?= $errorMessage ?></p>
    <div>
        <a href="index.php" class="text-link">fermer</a>
    </div>
</div>
<?php endif; ?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>