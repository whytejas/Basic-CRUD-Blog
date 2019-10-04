<?php   
require_once('model/frontend/articleManager.php');

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

public function editArticle($articleId) {

}
public function deleteArticle($articleId) {
    
    $bdd = $this->bddConnect();

    $req = $bdd->prepare('DELETE FROM Articles WHERE id=?');
    $req->execute(array($articleId));

    return $req;

}

}