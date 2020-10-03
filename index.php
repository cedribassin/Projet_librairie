<!-- index.php a maintenant un rôle de routage -->
<?php
require_once "controllers/LivresController.controller.php";
//On instancie le controller de livres
$livresController = new LivresController;

if(empty($_GET['page'])){
    require "views/accueil.view.php";
} else {
    switch($_GET['page']){
        //On définit les routes
        case "accueil": require "views/accueil.view.php";
        break;
        /*case "livres": require "views/livres.view.php";*/
        //On appelle la fonction afficherLivres
        case "livres": $livresController->afficherLivres();
        break;

    }
}
?>