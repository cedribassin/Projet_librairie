<!-- On récupère le code qui était dans index.php -->
<?php ob_start()?>

<p>Bienvenue sur l'application de gestion de vos livres.
Vous aurez la possibilité d'afficher les pages de couverture de vos livres, les titres
ainsi que le nombre de pages. Mais aussi modifier les informations fournies, ou encore les supprimer.</p>

<?php
$content = ob_get_clean();
$titre = "Bibliothèque MGA";
require "template.php";
?>