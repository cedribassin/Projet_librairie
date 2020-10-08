<?php
require_once "Model.class.php";
require_once "Livre.class.php";


class LivreManager extends Model {

    private $livres;//Tableau de livres

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
            $ouvrage= new Livre($livre['id_livre'], $livre['titre'], $livre['nbPages'], $livre['image']);
            //On les ajoute au tableau $livres via la fonction ajoutLivre()
            $this->ajoutLivre($ouvrage);
        }

    }

    public function getLivreById($id){
         for($i=0; $i<count($this->livres); $i++){
             //On vérifie si le getteur de Id est === à $id et on retourne le livre
             // avec le bon id
            if($this->livres[$i]->getId() === $id){
                return $this->livres[$i];
            }
         }
    }

    //Fonction qui permet d'insérer un livre en BDD et dans le tableau $livres
    public function ajoutLivreBdd($titre, $nbPages, $image){
        $req = "INSERT INTO livre (titre, nbPages, image) values (:titre, :nbPages, :image)";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        //Une fois inséré en BDD, on le rajoute dans notre tableau de livres ($livres)
        //On test si le résultat a retourné quelque chose, et si oui on crée notre livre dans $livres
        if($resultat>0){
            //lastInsertId permet de récupérer le dernier id créé en bdd
            $livre = new Livre($this->getBdd()->lastInsertId(), $titre, $nbPages, $image);
            $this->ajoutLivre($livre);
        }
    }

    public function suppressionLivreBdd($id){
        $req = "DELETE from livre WHERE id_livre = :idLivre";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":idLivre", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        //On vérifie que la suppression en BDD à fonctionné et on retire le livre du tableau $livres
        // en utilisant la fonction unset()
        if($resultat>0){
            $livre = $this->getLivreById($id);
            unset($livre);
        }

    }

    //Fonction qui permet de modifier un livre en BDD et dans le tableau $livres
    public function modificationLivreBdd($id, $titre, $nbPages, $image){
        $req = "UPDATE livre SET titre = :titre, nbPages = :nbPages, image = :image WHERE id_livre = :id";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            //On met à jour les résultat en utilisant les setters
            $this->getLivreById($id)->setTitre($titre);
            $this->getLivreById($id)->setNbPage($nbPages);
            $this->getLivreById($id)->setImage($image);
        }
    }

}


?>