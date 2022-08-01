<?php $title = "FLIGHT-MANAGER"; ?>

<?php ob_start(); ?>
<p class="error-message">Erreur : <?= $errorMessage ?></p>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>