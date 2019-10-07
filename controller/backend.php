<?php
session_start();
require_once('model/articleManager.php');
require_once('model/commentManager.php');


function passwordVerify($pseudo, $password) {
    $articleManager = new ArticleManager();
    $user = $articleManager -> verifyUser($pseudo);
        
    if (password_verify($password, $user['password_H']))  {
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['password'] = password_hash($password, PASSWORD_DEFAULT);
        listArticles();
    }
    else {

        throw new Exception("Vérifier votre pseudo et/ou mot de passe ! Essayez ici: <a href='view/frontend/loginView.php'> Connexion</a> ");
        
    }

}


function listArticles(){

    $articleManager = new ArticleManager();
    $articles = $articleManager->getArticles();

    require('view/backend/adminView.php');

}


function newArticle($titre, $contenu)
{
    $articleManager = new ArticleManager();
    $insertionArticle =  $articleManager->createArticle($titre, $contenu);

    if ($insertionArticle === false) {
        throw new Exception("Impossible d\'ajouter l'article !");
    }
    else {
        header('Location: ./adminIndex.php?action=list');
    }

}


function deletionArticle($articleId)
{
    $articleManager = new ArticleManager();
    $deletion =  $articleManager->deleteArticle($articleId);
    header('Location: ./adminIndex.php?action=list');

}


function modificationArticle($articleId)
{
    $articleManager = new ArticleManager();
    $article = $articleManager->getArticle($articleId);
    require('view/backend/adminModificationView.php');

}

function updateArticle($articleId, $modTitre, $modContenu)
{
    $articleManager = new ArticleManager();
    $updateArticle = $articleManager->updateArticle($articleId, $modTitre, $modContenu);
    
    if ($updateArticle === false) {
        throw new Exception("Impossible de modifier cet article !");
    }
    else {
        header('Location: ./adminIndex.php?action=getArticle&id=' .$articleId);
    }
   
}


function deletionCommentaire($articleId, $commentaireId)
{
    $articleManager = new ArticleManager();
    $commentManager = new CommentManager();
    $deletionComment =  $commentManager->deleteCommentaire($commentaireId);

    header('Location: ./adminIndex.php?action=getArticle&id=' .$articleId);

}



function listCommentairesAModerer() {
    
    $commentManager = new CommentManager();
    $commentsAModerer =  $commentManager->commentairesAModerer();
    require('view/backend/adminCommentView.php');

}


function getArticleByTitre($articleId) {
   
    $articleManager = new ArticleManager();
    $adminGetArticle = $articleManager->getArticle($articleId);
    $article = $adminGetArticle;

    $commentManager = new CommentManager();
    $adminGetCommentaires = $commentManager->getCommentaires($articleId);
    $commentaires = $adminGetCommentaires;


    if ($article === false) {
        throw new Exception("Impossible d\'ajouter l'article !");
    }
    else {
        require('view/backend/adminArticleView.php');
    }


}


