<?php

require_once('model/model.php');


function passwordVerify($pseudo, $password) {
    $adminArticleManager = new AdminArticleManager();
    $userCheck = $adminArticleManager -> verifyUser($pseudo, $password);

    if (password_verify($password, $userCheck['password_H']))  {

        return true;
    }
    else {
        header('Location: view/frontend/loginView.php');
    }

}



function listArticles()
{

    $adminArticleManager = new AdminArticleManager();
    $adminArticles = $adminArticleManager->getArticles();

    require('view/backend/adminView.php');


}




function newArticle($titre, $contenu)
{
    $adminArticleManager = new AdminArticleManager();
    $insertionArticle =  $adminArticleManager->createArticle($titre, $contenu);

    if ($insertionArticle === false) {
        throw new Exception("Impossible d\'ajouter l'article !");
    }
    else {
        header('Location: ./adminIndex.php?action=list');
    }

}


function deletionArticle($articleId)
{
    $adminArticleManager = new AdminArticleManager();
    $deletion =  $adminArticleManager->deleteArticle($articleId);
    header('Location: ./adminIndex.php?action=list');

}


function deletionCommentaire($articleId, $commentaireId)
{

    $adminCommentManager = new AdminCommentManager();
    $deletionComment =  $adminCommentManager->deleteCommentaire($commentaireId);
    header('Location: ./adminIndex.php?action=getArticle&id=' .$articleId);


}



function listCommentairesAModerer() {
    $adminCommentManager = new AdminCommentManager();
    $commentsAModerer =  $adminCommentManager->commentairesAModerer();
    require('view/backend/adminCommentView.php');

}


function getArticleByTitre($articleId) {
    $adminArticleManager = new AdminArticleManager();
    $adminGetArticle = $adminArticleManager->getArticle($articleId);
    $article = $adminGetArticle;

    $adminCommentManager = new AdminCommentManager();
    $adminGetCommentaires = $adminCommentManager->getCommentaires($articleId);
    $commentaires = $adminGetCommentaires;


    if ($article === false) {
        throw new Exception("Impossible d\'ajouter l'article !");
    }
    else {
        require('view/backend/adminArticleView.php');
    }



}


