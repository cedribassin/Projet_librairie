<?php

class Livre {

    private $id;
    private $titre;
    private $nbPage;
    private $image;


    public function __construct($id, $titre, $nbPage, $image){
        $this->id = $id;
        $this->titre = $titre;
        $this->nbPage = $nbPage;
        $this->image = $image;
    }
   
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getTitre(){return $this->titre;}
    public function setTitre($titre){$this->titre = $titre;}

    public function getNbPage(){return $this->nbPage;}
    public function setNbPage($nbPage){$this->nbPage = $nbPage;}

    public function getImage(){return $this->image;}
    public function setImage($image){$this->image = $image;}


}

?>