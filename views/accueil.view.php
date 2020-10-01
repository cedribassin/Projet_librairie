<!-- On récupère le code qui était dans index.php -->
<?php ob_start()?>

ici le contenu de ma page d'accueil

<?php
$content = ob_get_clean();
$titre = "Bibliothèque MGA";
require "template.php";
?>