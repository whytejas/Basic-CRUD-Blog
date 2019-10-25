<?php 

require_once('manager.php');

class userManager extends Manager {
   
    public function verifyUser($pseudo)  {
        $bdd = $this->bddConnect();
        $req= $bdd->prepare('SELECT password_H FROM Utilisateurs WHERE pseudo=? ');
        $req->execute(array($pseudo));
        $user = $req->fetch();
        
        return $user;
    }  

}
?>
