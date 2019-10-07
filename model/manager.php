<?php 

class Manager {

protected function bddConnect() {

    $bdd = new \PDO('mysql:host=127.0.0.1;port=8889;dbname=ProjetOC;charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $bdd;

}

}

?>