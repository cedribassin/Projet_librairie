<?php
session_start();

// On définit une constante de nom "URL" qui aura pour valeur:
// str_replace("index.php","", (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
// => dans str_replace:
//on recherche la valeur "index.php" (qu'on remplace pour l'instant à vide "") dans l'url:
// ensuite on test s'il s'agit d'un serveur https ou http et on continu le chemin de l'URL
// avec le nom du serveur ($_SERVER[HTTP_HOST]) et la page actuelle ($_SERVER[PHP_SELF])
define("URL", str_replace("index.php","", (isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/LivresController.controller.php";
$livresController = new LivresController;

try{
    if(empty($_GET['page'])){
        require "views/accueil.view.php";
    } else {
        //On décompose l'url en utilisant la fonction explode() à partir du caractère /,
        // ensuite on filtre le nom de la page avec filter_var() et on utilise la constante
        // prédéfinie FILTER_SANITIZE_URL (qui supprime tous les caractères sauf les lettres, 
        // chiffres et $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.) pour sécuriser un peu plus 
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
    
        // On peut maintenant utiliser notre tableau $url
        switch($url[0]){
            case "accueil": require "views/accueil.view.php";
            break;
            case "livres":
                if(empty($url[1])){
                    $livresController->afficherLivres();
                } else if($url[1]==="l"){
                    $livresController->afficherUnLivre($url[2]);
                } else if($url[1]==="a"){
                    $livresController->ajouterUnLivre();
                }  else if($url[1]==="m"){
                    $livresController->modifierUnLivre($url[2]);
                } else if($url[1]==="s"){
                    $livresController->supprimerUnLivre($url[2]);
                }  else if($url[1]==="av"){
                    $livresController->ajoutLivreValidation();
                } else if($url[1]==="mv"){
                    $livresController->modificationLivreValidation();
                } else {
                    throw new Exception("La page n'existe pas");
                }
            break;
            default :  throw new Exception("La page n'existe pas");
    
        }
    }
} catch(Exception $e){
    $msg =  $e->getMessage();
    require "views/error.view.php";
}

?>