<?php
require('controller/frontend.php');


try {
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listArticles') {
        listArticles();
    }

    elseif ($_GET['action'] == 'listCommentaires') {
        if (isset($_GET['id']) && $_GET['id'] >= 0) {
            listCommentaires();
        }
        else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }

    elseif ($_GET['action'] == 'newCommentaire') {
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
    }

    elseif ($_GET['action'] =='signalCommentaire'){
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
    }
}

else {
    listArticles();
}

}

catch (Exception $e) { 
    echo 'Erreur : ' . $e->getMessage();
}