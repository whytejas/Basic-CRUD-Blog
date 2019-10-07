<?php $title = 'Commentaires';
ob_start(); ?>

<p><a class="accueil" href="./index.php">Accueil</a>
<a class="login" href="./adminIndex.php?action=list">Espace Admin</a></p>

<h4>"Billet simple pour l'Alaska"</h4>


<div class="articles">
    <h3>
        <?= htmlspecialchars($article['titre']) ?>
        <em>le <?= $article['date_creation'] ?></em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($article['contenu'])) ?>
    </p>
</div>
<div class="formulaire">
    <h2>Commentaires</h2>


    <form action="./index.php?action=newCommentaire&id=<?= $article['id'] ?>" method="post">
        <div>
            <label for="auteur">Auteur :</label><br />
            <input type="text" id="auteur" name="auteur" /><br /><br />
            <label for="commentaireContenu">Commentaire :</label><br />
            <textarea id="commentaireContenu" name="commentaireContenu" rows="15" cols="30"></textarea><br /><br />
            <input type="submit" value ="Envoyer" />
        </div>
    </form>
   
    

        <?php
        while ($commentaire = $commentaires->fetch())
        {
        ?>
        <div class="commentaires"><p><strong><?= htmlspecialchars($commentaire['auteur']) ?></strong> a commenté le
            <?= $commentaire['date_commentaire'] ?></p>
        <p class="commentaireContenu"><?= nl2br(htmlspecialchars($commentaire['contenu'])) ?>
        <br><br>
        
        <?php
        if ($commentaire['moderation'] != 1 ) {
        ?>
        
        <span class="moderation"><a href="./index.php?action=signalCommentaire&id=<?php echo $commentaire['id']; ?>&moderation=<?php echo $commentaire['moderation']; ?>&articleId=<?php echo $article['id']; ?>" onclick="return confirm('Êtes-vous sûr et certain? Cette action est permanente !')">Signaler pour modération</a></span></p> 
        <?php } ?>
    </div>

    
</div>
<?php
         
    
        }
      
    $commentaires->closeCursor();
    ?>

<?php $content = ob_get_clean();
     require('view/frontend/template.php'); ?>