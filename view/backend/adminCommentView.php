<?php $title = 'Moderation'; ?>
<?php ob_start(); ?>




<div>

<h2>Commentaires à Moderer</h2>
<?php
if ($commentsAModerer) {
while ($commentsSignales = $commentsAModerer->fetch())
{
?>

<ul>
<li><?php echo "Le " . ($commentsSignales['date_commentaire']) . " : <br><br>" .  htmlspecialchars($commentsSignales['auteur']). " a écrit <br>" . htmlspecialchars($commentsSignales['contenu']); ?></li> 

<span><a href="./adminIndex.php?action=deleteCommentaire&id=<?php echo $commentsSignales['id']; ?>&articleId=<?php echo $commentsSignales['id_article']; ?>" onclick="return confirm('Êtes-vous sûr et certain? Cette action est permanente !')"> Supprimer</a> </span>

</ul>




</div>



<?php 
    }
      
    $commentsAModerer->closeCursor();

}

else {
    echo "PAS DE MODERATION NECESSAIRE";
}

$content = ob_get_clean();
require('view/frontend/template.php'); ?>