<?php $title = 'Article:' .$article['titre']; ?>
<?php ob_start(); ?>

<p><a class="login" href="./adminIndex.php?action=list">Espace Admin</a></p>

<h4>"Billet simple pour l'Alaska"</h4>
<h3><?php echo $article['titre']; ?></h3>

<p><a href="./index.php">Accueil</a></p>

<div class="articles">
    <h3>
        <?= htmlspecialchars($article['titre']) ?>
        <em>le <?= $article['date_creation'] ?></em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($article['contenu'])) ;




?>


        <br>
        <br> 
        <em><a href="./adminIndex.php?action=deleteArticle&id=<?php echo $article['id']; ?>" onclick="return confirm('Êtes-vous sûr et certain? Cette action est permanente !')">Supprimer</a></em>

        <br>
        <br> 
        <em><a href="./adminIndex.php?action=getArticleMod&id=<?php echo $article['id']; ?>">Modifier le contenu</a></em>
    </p>
</div>


<?php
        while ($commentaire = $commentaires->fetch())
        {
        ?>
        <div class="commentaires"><p><strong><?= htmlspecialchars($commentaire['auteur']) ?></strong> a commenté le
            <?= $commentaire['date_commentaire'] ?></p>
        <p class="commentaireContenu"><?= nl2br(htmlspecialchars($commentaire['contenu']));?>
        <br> 
        <em><a href="./adminIndex.php?action=deleteCommentaire&id=<?php echo $commentaire['id']; ?>&articleId=<?php echo $article['id']; ?>" onclick="return confirm('Êtes-vous sûr et certain? Cette action est permanente !')">Supprimer ce commentaire</a></em>
    </div>


<?php 
    }
      
    $commentaires->closeCursor();
$content = ob_get_clean();
require('view/frontend/template.php'); ?>