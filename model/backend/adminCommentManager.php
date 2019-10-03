<?php   

require_once('model/frontend/commentManager.php');

class AdminCommentManager extends CommentManager {



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