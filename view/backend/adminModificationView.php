<?php $title = 'Article:' .$article['titre']; ?>
<?php ob_start(); ?>

<p><a class="accueil" href="./index.php">Accueil</a>
<a class="logout" href="./adminIndex.php?action=logout">Logout</a></p>

<h4>"Billet simple pour l'Alaska"</h4>
<h3><?php echo $article['titre']; ?></h3>

<p><a href="./index.php">Accueil</a></p>

<div class="articles">

<h2>Modifier cet Article</h2>
   

<h3> 
        
    Dernière version crée <em>le <?= $article['date_creation'] ?></em>
    </h3>

    <form action="./adminIndex.php?action=updateArticle&id=<?= $article['id'] ?>" method="POST">
        <div>
            <label for="titre">Titre :</label><br />
            <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($article['titre']) ?>">
            
            <br/><br />
            <label for="contenu">Contenu :</label><br />
            <textarea id="contenu" name="contenu" rows="20" cols="60" class="mytextarea"><?php echo($article['contenu']) ?></textarea>
            
            <br /><br />
            <input type="submit" value="Mettre à jour" onclick="return confirm('ATTENTION : La dernière version va être remplacée par celle-ci !! ')"/>
        </div>
    </form>
</div>
   
       
<?php
$content = ob_get_clean();
require('view/frontend/template.php'); ?>