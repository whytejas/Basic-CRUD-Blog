<?php
require_once('model/articleManager.php');
require_once('model/commentManager.php');


function listArticles($page, $perPage)
{
    if ($page > 1) {
        $start = ($page - $perPage) * $perPage;  
    }
    
    else {
        $start = 0;
    }
    
    $articleManager = new ArticleManager();
    $articles = $articleManager->paginateArticles($start, $perPage);
    
    $total = $articleManager->totalArticles();
    $totalPages = ceil($total/$perPage);
    
    require('view/frontend/view.php');
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


function moderationCommentaire($articleId, $commentaireId)
{
    $articleManager = new ArticleManager();
    $commentManager = new CommentManager();
    $modererComment =  $commentManager->modererCommentaire($commentaireId);

    header('Location: ./index.php?action=listCommentaires&id=' . $articleId);




}