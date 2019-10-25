<?php 
$title = 'Espace ADMIN';
ob_start(); 
?>

<p>
    <a class="accueil" href="index.php">Accueil</a>
</p>

<div class="loginForm">
    <p><em>Veuillez entrer vos identifiants pour accéder à </em><br> l'ESPACE ADMIN :
    </p>

    <form class="login" action="adminIndex.php?action=login" method="POST">
        <p>
            <label for="pseudo"> Pseudo :<br> 
            <input type="text" name="pseudo" /><br><br>
            <label for="password"> Mot de passe :<br> 
            <input type="password" name="password" /><br><br>
            <input type="submit" name="submit" value="Valider" />

        </p>
    </form>
    <span class="attention">ATTENTION: Cette page est réservée à l'écrivain.</span>
</div>

<?php 
$content = ob_get_clean();
require('view/frontend/template.php'); 
?>