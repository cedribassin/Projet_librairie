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

    //Fonction qui permet d'ajouter un livre
    public function ajouterUnLivre(){
        require "views/ajoutLivre.view.php";
    }

    //Fonction qui permet de valider l'ajout d'un livre
    public function ajoutLivreValidation(){
        //On insère l'information de l'image dans la variable $file
        $file = $_FILES['image'];//=> possibilité de faire echo "<pre>"; print_r($file) echo "</pre>"; pour visualiser les info d'une image
        $repertoire = "public/images/";
        $imageAjoute = $this->ajoutImage($file, $repertoire);
        //On l'insère dans aussi en BDD
        $this->livreManager->ajoutLivreBdd($_POST['titre'], $_POST['nbPages'], $imageAjoute);
        //On redirige l'utilisateur vers la page listant tous les livres
        header('Location: '. URL . 'livres');
    }

    //Fonction qui permet d'insérer une image
    private function ajoutImage($file, $dir){
        //On vérifie si une image est renseignée dans le formulaire
        if(!isset($file['name']) || empty($file['name'])){
            throw new Exception("Vous devez indiquer une image");
        }
        //On vérifie si le repertoire de destination existe, et si ce n'est pas le cas
        // on le créé => cf droit d'accès 0777
        if(!file_exists($dir)){
            mkdir($dir,0777);
        } 
        //On récupère l'extension du fichier
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        //On génère un chiffre aléatoire pour ajouter un nom de fichier aléatoire dans l'image 
        // qui sera ajouté dans les dossiers => permet d'éviter les doublons
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];

        //On vérifie que:
        // le fichier est bien une image
        if(!getimagesize($file['tmp_name'])){
            throw new Exception("Le fichier n'est pas une image");
        }
        //Qu'il possède les bonnes extensions
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif"){
            throw new Exception("L'extension du fichier n'est pas reconnu");
        }
        //Qu'il n'existe pas déjà
        if(file_exists($target_file)){
            throw new Exception("Le fichier existe déjà");
        }
        //Que le fichier n'est pas trop gros
        if($file['size'] > 500000){
            throw new Exception("Le fichier est trop gros");
        }
        //On vérifie que le fichier a bien été transféré dans le dossier
        if(!move_uploaded_file($file['tmp_name'], $target_file)){
            throw new Exception("L'ajout de l'image n'a pas fonctionné");
        }
        //Si move_uploaded_file fonctionne on renvoie au programme appellant le nom de 
        //l'image qui aura été rajouté dans le dossier
        else return ($random."_".$file['name']);

    }

}



?>