<?php 
$title = 'ESPACE ADMIN';
ob_start(); 
?>

<p>
    <a class="accueil" href="./index.php">Accueil</a>
    <a class="logout" href="./adminIndex.php?action=logout">Logout</a>
</p>

<div class="intro">
    <h1>Bonjour Jean !</h1>
    <span>Ici vous pouvez:
        <ul class="list">
            <li>rédiger</li>
            <li>mettre à jour</li>
            <li>supprimer</li>
        </ul>
        les chapitres de votre nouveau roman : "Billet simple pour l'Alaska"
    </span>
    <br>
    <br>
    <span>En plus, vous pouvez <a href="#mod">moderer les commentaires signalés</a> par vos lecteurs ici.
    </span>
</div>

<div class="create">
    <h2>Rédiger un nouvel article</h2>


    <form action="./adminIndex.php?action=newArticle" method="post">
        <div>
            <label for="titre">Titre :</label><br>
            <input type="text" id="titre" name="titre">
            <br>
            <br>
            <label for="contenu">Contenu :</label><br>
            <textarea class="mytextarea" id="contenu" name="contenu" rows="20" cols="60"></textarea>
            <br>
            <br>
            <input type="submit" value="Envoyer" />
        </div>
    </form>
</div>

<br>
<br>
<h2>Lire, Modifier ou Supprimer un article</h2>
<h3> Choisissez un titre :</h3>

<div class="articleTitles">
    <?php 
    while ($donnees = $articles->fetch()){
    ?>

    <ul>
        <li><a href="./adminIndex.php?action=getArticle&id=<?php echo $donnees['id']; ?>"><?php echo htmlspecialchars($donnees['titre']); ?></a></li><br>
    </ul>

    <?php
    }
    ?>

</div>

<div id="mod">
    <h2>Commentaires à Moderer</h2>
    <a href="./adminIndex.php?action=listCommentairesAModerer">Cliquez ici</a>
</div>

<?php
$content = ob_get_clean();
require('view/frontend/template.php'); 
?>