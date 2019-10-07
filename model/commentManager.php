<?php 
require_once('manager.php');

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

    public function modererCommentaire($commentaireId) {
        $bdd = $this->bddConnect();
            $req = $bdd->prepare('UPDATE Commentaires SET moderation = 1 WHERE id = ?');
            $req->execute(array($commentaireId));
          
            return $req;
    
    }

    public function commentairesAModerer() {
    
        $bdd = $this->bddConnect();
        $req= $bdd->query('SELECT * FROM Commentaires WHERE moderation = 1');
        return $req;
    
    }
    
    public function deleteCommentaire($commentaireId) {
    
        $bdd = $this->bddConnect();
    
        $req = $bdd->prepare('DELETE FROM Commentaires WHERE id=?');
        $req->execute(array($commentaireId));
    
        return $req;
    }

}

?>