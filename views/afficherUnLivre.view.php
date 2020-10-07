<?php 
require_once "models/LivreManager.class.php";
ob_start();
?>
    <div class="row">
        <div class="col-6">
            <img src="<?= URL ?>public/images/<?= $livre->getImage();?>"/>
        </div>
        <div class="col-6">
            <p>Nombre de pages : <?= $livre->getNbPage()?> </p>
        </div>
    </div>
<?php
//$content récupère le contenu du buffer
$content = ob_get_clean();
$titre = $livre->getTitre();// variable récupérée dans le template pour afficher le titre de la page
require "template.php";
?>
