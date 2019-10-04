<?php   

// namespace OpenClassrooms\Blog\Model;

require_once('model/frontend/Manager.php');

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