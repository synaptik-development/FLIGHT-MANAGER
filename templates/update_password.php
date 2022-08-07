<?php $title = 'FLIGHT-MANAGER modification du mot de passe'; ?>

<?php ob_start() ?>
<div class="update-password">
    <header class="header">
        <img src="images/logo.png" alt="logo flight-manager">
        <h1>FLIGHT-MANAGER</h1>
        <a class="dashboard-link text-link" href="index.php">tableau de bord</a>
    </header>

    <h2>MODIFICATION DU MOT DE PASSE</h2>

    <form class="fixed-window" action="index.php?action=updatePassword&userId=<?= $user->id; ?>" method="POST">
        <input type="password" name="password" id="password" placeholder=" Ancien mot de passe">
        <input type="password" name="new-password" id="new-password" placeholder=" Nouveau mot de passe">
        <input type="password" name="confirm-password" id="confirm-password" placeholder=" Confirmer mot de passe">
        <button class="btn" type="submit">valider</button>
        <a href="index.php?action=user&id=<?= $user->id ?>" class="text-link">annuler</a>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>