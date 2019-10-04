<?php 
session_start();

$title = 'Espace ADMIN';
ob_start(); 




if (!isset($_POST['password']) OR (!isset($_POST['pseudo']) OR (!password_verify($_POST['password'], '$2y$10$3GdWxyFLn.5iP4EOZiEYVOv49eqbzX8SK6q6kSm9TCZPRinaVaLS2')) OR $_POST['pseudo'] != "jeanF" )){ 
 ?>

    <div class="loginForm">
    <p><em>Veuillez entrer vos identifiants pour accéder à </em><br> l'ESPACE ADMIN :</p>
    <form class="login" action="loginView.php" method="post">
        <p>
        <label for="pseudo"> Pseudo  :<br>  <input type="text" name="pseudo" /><br><br>
        <label for="password"> Mot de passe :<br>   <input type="password" name="password" /><br><br>
        <input type="submit" value="Valider" />
        </p>
    </form>
    <span class="attention">ATTENTION: Cette page est réservée à l'écrivain.<span></div>
    <?php 





}
else {

    $_SESSION['pseudo'] = $_POST['pseudo'];
    $_SESSION['password'] = $_POST['password'];
    $pseudo = $_SESSION['pseudo'];
    $password = $_SESSION['password'];

    if ($pseudo === "jeanF" && $password === "kangourou" ){
    header("Location: ./../../adminIndex.php?action=list");
}
}

$content = ob_get_clean();
require('../frontend/template.php'); ?> 