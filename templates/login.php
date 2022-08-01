<?php $title = 'FLIGHT-MANAGER connexion'; ?>

<?php ob_start() ?>
<div id="login-body">
    <h1>FLIGHT MANAGER</h1>

    <form id="login-form" action="index.php?action=login" method="POST">
        <h2>connexion</h2>
        <input type="text" name="email" id="email" placeholder="EMAIL">
        <input type="text" name="password" id="password" placeholder="MOT DE PASSE">
        <br>
        <input type="submit" />
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>