<?php
require_once "Model.class.php";
require_once "Livre.class.php";


class LivreManager extends Model {

    private $livres;

    //Ici "il n'y a pas le constructeur" car celui-ci est vide donc cela revient
    // au même que si on l'avait écrit sans rien

    //Fonction qui permet d'ajouter des livres dans le tableau $livres
    public function ajoutLivre($livre){
        return $this->livres[]=$livre;
    }

    public function getLivres(){
        return $this->livres;
    }

    //Fonction qui permet de récupérer les livres contenu dans la BDD pour créer directement les objets livre
    public function recupLivresBdd(){
        //On crée une variable $req qui contient la connexion à la bdd ($this car on hérite de la classe
        // Model) et la requête à effectuer
        $req = $this->getBDD()->prepare("SELECT * FROM livre");
        $req->execute();
        $mesLivres = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();//=> On finalise la requête et on libère les accès à la BDD pour une autre requête

        //On créer les objets livre issus de la bdd
        foreach($mesLivres as $livre){
            $ouvrage= new Livre($livre['id_livre'], $livre['titre'], $livre['Nb_page'], $livre['image']);
            //On les ajoute au tableau $livres via la fonction ajoutLivre()
            $this->ajoutLivre($ouvrage);
        }

    }

}


?>