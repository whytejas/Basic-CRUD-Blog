<?php 

require_once('model/backend/adminArticleManager.php');
require_once('model/backend/adminCommentManager.php');


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



    function moderationCommentaire($articleId, $commentaireId)
{  
    $adminArticleManager = new AdminArticleManager();
        $adminCommentManager = new AdminCommentManager();
        $modererComment =  $adminCommentManager->modererCommentaire($commentaireId);
        
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


