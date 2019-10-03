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
}

else {
    listArticles();
}

}

catch (Exception $e) { 
    echo 'Erreur : ' . $e->getMessage();
}