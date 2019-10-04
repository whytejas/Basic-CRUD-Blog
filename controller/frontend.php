<?php

require_once('model/frontend/articleManager.php');
require_once('model/frontend/commentManager.php');


function listArticles()
{
    $articleManager = new ArticleManager();
    $articles = $articleManager->getArticles();

    require('view/frontend/mainView.php');
}

function listCommentaires()
{
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $article = $articleManager->getArticle($_GET['id']);
        $commentaires = $commentManager->getCommentaires($_GET['id']);

        require('view/frontend/postView.php');
    
}


function newCommentaire($articleId, $auteur, $commentaireContenu)
{
        $commentManager = new CommentManager();
        $insertionCommentaire =  $commentManager->postCommentaire($articleId, $auteur, $commentaireContenu);

        if ($insertionCommentaire === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: ./index.php?action=listCommentaires&id=' . $articleId);
        }
}