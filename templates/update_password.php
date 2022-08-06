<?php $title = 'FLIGHT-MANAGER modification du mot de passe'; ?>

<?php ob_start() ?>

<header class="header">
    <img src="images/logo.png" alt="logo flight-manager">
    <h1>FLIGHT-MANAGER</h1>
    <a class="dashboard-link text-link" href="index.php">tableau de bord</a>
</header>

<form class="fixed-window" action="index.php?action=updatePassword&userId=<?= $user->id; ?>" method="POST">
    <h2>modifier le mot de passe</h2>
    <input type="password" name="password" id="password" placeholder=" Ancien mot de passe">
    <input type="password" name="new-password" id="new-password" placeholder=" Nouveau mot de passe">
    <input type="password" name="confirm-password" id="confirm-password" placeholder=" Confirmer mot de passe">
    <button class="btn" type="submit">valider</button>
    <a href="index.php?action=user&id=<?= $user->id ?>" class="text-link">annuler</a>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>