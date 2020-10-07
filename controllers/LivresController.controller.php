<?php 
require_once "models/LivreManager.class.php";

//Au moment de l'instanciation de LivresController, il instancie lui-même un livreManager
// et récupére toutes les données de la BDD. Le livreManager est ensuite accessible dans 
// l'attribut $livreManager.
class LivresController{

    private $livreManager;

    //Le constructeur instanciera directement le livreManager, puis le chargement des livres
    public function __construct(){
        //En mettant $this devant, on peut directement remplir l'attribut $livreManager
        $this->livreManager = new LivreManager; 
        $this->livreManager->recupLivresBdd();
    }

    //Fonction qui permettra d'afficher tous les livres dans libres.view.php
    public function afficherLivres(){
        //On récupère tous les livres qu'on met ensuite dans l'attribut $livres
        $livres = $this->livreManager->getLivres();
        require "views/livres.view.php";
    }

    //Fonction qui permet de récupérer un livre
    public function afficherUnLivre($id){
      //On utilise la fonction getLivreById() dans LivreManager pour récupérer 1 livre en BDD  
      $livre = $this->livreManager->getLivreById($id);
      //Necessite un nouvel affichage réalisé dans afficherUnLivre.view.php
      require "views/afficherUnLivre.view.php";
    }

}



?>