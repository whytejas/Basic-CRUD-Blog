<?php 


class Manager {

    protected function bddConnect() {
    
        $bdd = new \PDO('mysql:host=127.0.0.1;port=8889;dbname=ProjetOC;charset=utf8', 'root', 'root');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $bdd;

    }

}

//
//
// FRONTEND
//
//

// ARTICLE MANAGER : LECTEURS

class ArticleManager extends Manager {

    public function getArticles() {

        $bdd = $this->bddConnect();
        $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM Articles ORDER BY date_article DESC LIMIT 0, 4');
        
        return $req;

    }

    public function getArticle($articleId) {

        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM Articles WHERE id = ?');
        $req->execute(array($articleId));
        $article = $req->fetch();

        return $article;

    }


}

// COMMENT MANAGER : LECTEURS

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

}


//
//
// BACKEND
//
//
// ARTICLE MANAGER : ADMIN

class AdminArticleManager extends ArticleManager {


    public function verifyUser($pseudo, $password)  {
        $bdd = $this->bddConnect();
        $req= $bdd->prepare('SELECT password_H FROM Utilisateurs WHERE pseudo=? ');
        $req->execute(array($pseudo));
        $user = $req->fetch();
    
       return $user;

}


public function createArticle($titre, $contenu)  {

        $bdd = $this->bddConnect();
        
        $newArticle = $bdd->prepare('INSERT INTO Articles(titre, contenu, date_article) VALUES(?, ?, NOW())');
        $insertionArticle = $newArticle->execute(array($titre, $contenu));
    
        return $insertionArticle;      


}

public function modifierArticle($articleId) {
    
    $bdd = $this->bddConnect();
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM Articles WHERE id = ?');
    $req->execute(array($articleId));
    $article = $req->fetch();

    return $article;

}

public function updateArticle($articleId,$modTitre, $modContenu) {
    
    $bdd = $this->bddConnect();
    $req = $bdd->prepare('UPDATE Articles SET titre = ?, contenu = ?, date_article = NOW() WHERE id = ? ');
    $req->execute(array($modTitre, $modContenu,$articleId));

    return $req;

}



public function deleteArticle($articleId) {
    
    $bdd = $this->bddConnect();

    $req = $bdd->prepare('DELETE FROM Articles WHERE id=?');
    $req->execute(array($articleId));

    return $req;

}

}

// COMMENT MANAGER : ADMIN


class AdminCommentManager extends CommentManager {

   
    
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

