<?php 

require_once('manager.php');

class ArticleManager extends Manager {
    
    public function getArticles() {

        $bdd = $this->bddConnect();
        $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM Articles ORDER BY date_article DESC');
        
        return $req;
    }

    public function paginateArticles($start, $perPage) {

        $bdd = $this->bddConnect();
        $articles = $bdd->prepare("SELECT * FROM Articles ORDER BY date_article DESC LIMIT :start, :perPage  " );
        $articles->bindParam(':start', $start, PDO::PARAM_INT);
        $articles->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $articles->execute();
       
        return $articles;
    }


    public function totalArticles(){
        
        $bdd = $this->bddConnect();
        $req = $bdd->query("SELECT COUNT(*)AS total FROM Articles");
        $total = $req->fetch()['total'];
        
        return $total;
    }

    public function getArticle($articleId) {

        $bdd = $this->bddConnect();
        $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM Articles WHERE id = ?');
        $req->execute(array($articleId));
        $article = $req->fetch();

        return $article;
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

        $commentReq = $bdd->prepare('DELETE FROM Commentaires WHERE EXISTS (SELECT * FROM Articles WHERE ? = Commentaires.id_article)');
        $commentReq->execute(array($articleId));  
                   
        $req = $bdd->prepare('DELETE FROM Articles WHERE id=?');
        $req->execute(array($articleId));

        return $req;
    }

}

?>