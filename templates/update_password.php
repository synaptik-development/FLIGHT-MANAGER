<?php $title = 'FLIGHT-MANAGER modification du mot de passe'; ?>

<?php ob_start() ?>
<!-- formulaire modification du mot de passe -->
<!-- <div class="absolute-window background-window"> -->
<form class="fixed-window" action="index.php?action=updatePassword&userId=<?= $user->id; ?>" method="POST">
    <h2>modifier le mot de passe</h2>
    <input type="password" name="password" id="password" placeholder=" Ancien mot de passe">
    <input type="password" name="new-password" id="new-password" placeholder=" Nouveau mot de passe">
    <input type="password" name="confirm-password" id="confirm-password" placeholder=" Confirmer mot de passe">
    <button class="btn" type="submit">valider</button>
    <p class="cancel text-link">annuler</p>
</form>
<!-- </div> -->

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>