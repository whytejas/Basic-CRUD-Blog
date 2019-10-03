<?php
    session_start();

    require('controller/backend.php');




    try {
        if  (isset($_SESSION['pseudo']) && isset($_SESSION['password'])){
        if  ($_SESSION['pseudo'] === "jeanF" && $_SESSION['password'] === "kangourou"){

            if (isset($_GET['action'])){

                if ($_GET['action'] == 'list') {
                    listArticles();
                }

                elseif ($_GET['action'] == 'newArticle') {
                        if (!empty($_POST['titre']) && !empty($_POST['contenu'])){
                            newArticle($_POST['titre'], $_POST['contenu']);
                        
                        }

                    }

                elseif ($_GET['action'] == 'deleteArticle')  {
                    
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {
                        
                        deletionArticle($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }

                }

                elseif ($_GET['action'] == 'getArticle')  {
                    
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {

                        getArticleByTitre($_GET['id']);
                
                }

                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
                }


                elseif ($_GET['action'] == 'listCommentaires') {
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {
                        listCommentaires();
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }

                elseif ($_GET['action'] == 'deleteCommentaire') {
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {
                        if (isset($_GET['articleId']) && $_GET['articleId'] >= 0) {
                        deletionCommentaire($_GET['articleId'], $_GET['id']);
                        }
                        else {
                            throw new Exception('Aucun identifiant de article envoyé');
                        }
                    }
                    else {
                        throw new Exception('Aucun identifiant de commentaire envoyé');
                    }
                }


                elseif ($_GET['action'] == 'signalCommentaire') {
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {
                        if (isset($_GET['articleId']) && $_GET['articleId'] >= 0) {
                            if ($_GET['moderation'] != 1){
                        moderationCommentaire($_GET['articleId'], $_GET['id']);
                        
                    }

                    elseif ($_GET['moderation'] = 1){
                        echo 'Ce commentaire a déjà été signalé ! ';
                    }

                        }
                        else {
                            throw new Exception('Aucun identifiant de article envoyé');
                        }
                    }
                    else {
                        throw new Exception('Aucun identifiant de commentaire envoyé');
                    }
                }



                elseif ($_GET['action'] == 'listCommentairesAModerer') {
                  
                    listCommentairesAModerer();
                    
                }



               

            
        }
        else {
            listArticles();
        }

            }
            else {
                throw new Exception('Vérifiez votre pseudo et / ou mot de passe');
            }
        }
            else {
                throw new Exception('<h2>Vous devez vous connecter ! <a href="view/frontend/loginView.php">Cliquez ici</a></h2>' );
            }
        }

    catch (Exception $e) { 
        echo 'Erreur : ' . $e->getMessage();
    }
?>


