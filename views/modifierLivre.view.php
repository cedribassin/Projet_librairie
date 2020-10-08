<?php 
require_once "models/LivreManager.class.php";
ob_start();
?>
<!-- Au moment du clique on renverra les infos vers l'url contenu dans action, 
 comme on insère une image, on est obligé d'insérer un entype pour récupérer les données correctement -->
<form method="POST" action="<?= URL ?>livres/mv" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Titre :</label>
        <!-- On met un name car c'est l'information véhiculée au serveur -->
        <input type="text" class="form-control" id="titre" name="titre" value="<?=$livre->getTitre()?>">
    </div>
    <div class="form-group">
        <label for="nbPages">Nombre de pages :</label>
        <input type="number" class="form-control" id="nbPages" name="nbPages" value="<?= $livre->getNbPage()?>">
    </div>
    <h3>Image : </h3>
    <img src='<?= URL ?>public/images/<?= $livre->getImage();?>'/>
    <div class="form-group">
            <label for="image">Changer l'image</label>
            <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <!-- Va permettre de récupérer dans $_post la propriété identifiant qui contiendra l'id du livre 
    (=> utile dans modificationLivreValidation() du controller)  -->
    <input type="hidden" name="identifiant" value="<?= $livre->getId();?>">  
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
//$content récupère le contenu du buffer
$content = ob_get_clean();
$titre = "Modification du livre: ".$livre->getId();// variable récupérée dans le template pour afficher le titre de la page
require "template.php";
?>
