<?php 

abstract class Model{

    //$pdo va permettre de manipuler les données de la bdd et il contiendra l'instance
    // de la connexion à la bdd
    private static $pdo;

    //Fonction qui va permettre faire la connexion à la bdd et de remplir $pdo avec 
    private static function setBdd(){
       //On rempli le constructeur de PDO fourni par PHP 7 ('root' correspond au login et '' au password)
       self::$pdo = new PDO("mysql:host=localhost;dbname=librairie;charset=utf8",'root','');
       //On définit 2 éléments de paramétrage pour PDO, qui permettent de gérer les erreurs
       self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //Fonction qui va permettre de se connecter à la BDD quand ce sera nécessaire (en protected pour qu'elle
    // soit accessible par les classes fille)
    protected function getBDD(){
        //On test s'il y a déjà une connexion parametrée
        if(self::$pdo===null){
            //Si il n'y a pas de connexion on l'a crée
            self::setBdd();
        }
        return self::$pdo;
    }
}


?>