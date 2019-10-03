<?php $title = 'Jean Forteroche';

ob_start(); ?>

<p><a class="login" href="view/frontend/loginView.php">Espace Admin</a></p>
<div class="intro">
    <h1>Bonjour ! </h1>
    <h2>Je suis Jean Forteroche <br>(acteur et écrivain)</h2>
    <span>Ici vous pouvez lire mon nouveau roman :</span>
    <h4>"Billet simple pour l'Alaska"</h4>

    Je vais publier mon livre par chapitre en ligne sur ce site. Chaque nouvel episode sera publié dans un article.<br>
    Consultez les 3 derniers chapitres ici: </p>
</div>


<?php 

while ($donnees = $articles->fetch())
{
?>

<div class="articles">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation']; ?></em>
    </h3>

    <p>
        <?php
    echo nl2br(htmlspecialchars($donnees['contenu']));
   
    ?>
        <br>
        <br>
        <em><a href="./index.php?action=listCommentaires&id=<?php echo $donnees['id']; ?>">Commentaires</a></em>
    </p>
</div>


<?php
} 
$articles->closeCursor();
 $content = ob_get_clean();
 require('view/frontend/template.php');
 ?>