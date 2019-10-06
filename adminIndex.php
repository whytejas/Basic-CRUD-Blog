<?php
session_start();
require('controller/backend.php');


try {
    
    if (isset($_POST['pseudo'])  && isset($_POST['password'])){
       
        if  (!empty($_POST['pseudo']) AND !empty($_POST['password'])) {
            
            if(passwordVerify($_POST['pseudo'], $_POST['password'])) {

                $_SESSION['pseudo'] = $_POST['pseudo'];
                $_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                listArticles();
            }

            else {
                throw new Exception("Vérifier votre pseudo et/ou mot de passe ! Essayez ici: <a href='view/frontend/loginView.php'> Connexion</a> ");
                header('Location: view/frontend/loginView.php');
            }

        }

        else {
            throw new Exception('Les deux identifiants sont obligatoires.  Essayez ici: <a href="view/frontend/loginView.php"> Connexion</a>  ');
        }

    }

    elseif (isset($_SESSION['password']) && isset($_SESSION['pseudo'])) {

        if (isset($_GET['action'])) {

            switch($_GET['action']) {

                case 'list':
                    listArticles();
                    break;

                case  'newArticle':
                    if (!empty($_POST['titre']) && !empty($_POST['contenu'])){
                        newArticle($_POST['titre'], $_POST['contenu']);
                    }
                    else {
                        throw new Exception('impossible d\'ajouter l\'article ');
                    }
                    break;

                case 'deleteArticle':
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {
                        deletionArticle($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                    break;

                case 'getArticleMod':
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {
                        modificationArticle($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                    break;    

                case 'getArticle':
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {
                        getArticleByTitre($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                    break;


                case 'updateArticle': 
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {
                        if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {
                                updateArticle($_GET['id'], $_POST['titre'], $_POST['contenu']);
                        }
                        else {
                            throw new Exception('Tous les champs ne sont pas remplis !');
                        }
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                    break;   

                case 'listCommentaires':
                    if (isset($_GET['id']) && $_GET['id'] >= 0) {
                        listCommentaires();
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                    break;

                case 'deleteCommentaire':
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
                    break;

                case 'listCommentairesAModerer':
                    listCommentairesAModerer();
                    break;
            }
        }

        elseif (!isset($_GET['action'])){
            echo "NO";
            listArticles();
        }
    }

    else {
        throw new Exception("Vous devez vous reconnecter ! Essayez ici: <a href='view/frontend/loginView.php'> Connexion</a> ");
        header('Location: view/frontend/loginView.php');
    }


}


catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>


