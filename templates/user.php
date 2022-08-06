<?php $title = "FLIGHT-MANAGER accueil"; ?>

<?php ob_start(); ?>

<!-- affichage des infos utilisateur -->
<div class="user">
    <header class="header">
        <img src="images/logo.png" alt="logo flight-manager">
        <h1>FLIGHT-MANAGER</h1>
        <a class="dashboard-link" href="index.php">tableau de bord</a>
    </header>

    <!-- <a class="dashboard-link" href="index.php">tableau de bord</a> -->

    <main class="user_main">
        <?php if ($user->id === $_SESSION['userId'] || $user->isManager == 1) : ?>
        <strong><?= $user->lastname . ' ' . $user->firstname ?></strong>

        <?php if ($user->isPilot == 1) : ?>
        <span>PILOTE</span>
        <?php endif; ?>
        <?php if ($user->isInstructor == 1) : ?>
        <span>INSTRUCTEUR</span>
        <?php endif; ?>
        <?php if ($user->isManager == 1) : ?>
        <span>MANAGER</span>
        <?php endif; ?>

        <p>
            Adresse mail :
            <span><?= $user->email ?></span>
        </p>

        <p>
            Date d'inscription :
            <span><?= date_format($user->inscriptionDate, 'd-m-Y') ?></span>
        </p>

        <p>
            Heures de vol :
            <span><?= $user->timeCounter ?></span>
        </p>

        <p>
            Crédits :
            <span><?= $user->credits . ' €' ?></span>
        </p>

        <?php if ($user->id === $_SESSION['userId']) : ?>
        <p>
            Mot de passe :
            <span><?= $user->password ?> </span>
            (<a href="index.php?action=updatePassword&userId=<?= $user->id; ?>" class="text-link"
                id="reveal_update-password-form">modifier</a>)
        </p>
        <?php endif; ?>

        <div class="btn btn--alert" id="reveal_delete-user-form">supprimer le compte</div>

        <?php else : ?>
        <p>Accés non autorisé</p>
        <a href="index.php">Retour à l'accueil</a>
        <?php endif; ?>
    </main>
</div>

<!-- formulaire suppression du compte -->
<div class="absolute-window background-window hidden" id="delete-user-form">
    <form class="fixed-window" action="index.php?action=deleteProfil&userId=<?= $user->id; ?>" method="POST">
        <h2>suppression du compte</h2>
        <input type="password" name="password" id="password" placeholder=" Mot de passe">
        <button class="btn btn--alert" type="submit">supprimer</button>
        <p class="cancel text-link">annuler</p>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>