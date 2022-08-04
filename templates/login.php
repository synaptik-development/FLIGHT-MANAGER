<?php $title = 'FLIGHT-MANAGER connexion'; ?>

<?php ob_start() ?>
<div class="login" id="login">
    <header class="login_header">
        <img src="images/logo.png" alt="logo flight-manager">
        <h1>FLIGHT-MANAGER</h1>
    </header>

    <form class="login_form" id="login_form" action="index.php?action=login" method="POST">
        <h2>connexion</h2>
        <input type="text" name="email" id="email" placeholder="EMAIL">
        <input type="text" name="password" id="password" placeholder="MOT DE PASSE">
        <br>
        <input type="submit" />
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>