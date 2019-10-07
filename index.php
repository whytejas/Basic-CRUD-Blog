<?php
require('controller/frontend.php');


try {

    if (isset($_GET['action'])) {

        switch($_GET['action']) {

            case 'listArticles': 
                if ((isset($_GET['page'])) && ((int)$_GET['page'])){
                    $page = $_GET['page'];
                    
                    if ((isset($_GET['perpage'])) && ((int)$_GET['perpage']) && $_GET['perpage'] <= 10) {
                    $perPage = $_GET['perpage'];
                    }
                    else { 
                        
                        $perPage = 1;
                    } 
                listArticles($page, $perPage);        
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


            case 'newCommentaire' :
                if (isset($_GET['id']) && $_GET['id'] >= 0) {
                    if (!empty($_POST['auteur']) && !empty($_POST['commentaireContenu'])) {
                        newCommentaire($_GET['id'], $_POST['auteur'], $_POST['commentaireContenu']);
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                    }
                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
                break;
    

            case 'signalCommentaire':
                if (isset($_GET['id']) && $_GET['id'] >= 0) {
                    if (isset($_GET['articleId']) && $_GET['articleId'] >= 0) {
                        if ($_GET['moderation'] != 1){
                            moderationCommentaire($_GET['articleId'], $_GET['id']);
                        }  
                    }   
                    else {
                        throw new Exception('Aucun identifiant de article envoyé');
                    }
                }
                else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
                break;
        }
    }

else {

    listArticles(1, 3);
}

}

catch (Exception $e) { 
    echo 'Erreur : ' . $e->getMessage();
}