<?php

// namespace OpenClassrooms\Blog\Model;

require_once('model/frontend/Manager.php');

class CommentManager extends Manager {

    public function getCommentaires($articleId) {
    
        $bdd = $this->bddConnect();
        $commentaires = $bdd->prepare('SELECT id, auteur, contenu, moderation, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire FROM Commentaires WHERE id_article = ? ORDER BY date_commentaire DESC');
        $commentaires->execute(array($articleId));
    
        return $commentaires;

    }
    
    public function postCommentaire($articleId, $auteur, $commentaireContenu) {
    
        $bdd = $this->bddConnect();
        $comments = $bdd->prepare('INSERT INTO Commentaires(id_article, auteur, contenu, date_commentaire) VALUES(?, ?, ?, NOW())');
        $insertionCommentaire = $comments->execute(array($articleId, $auteur, $commentaireContenu));
    
        return $insertionCommentaire;
        
    }

}



