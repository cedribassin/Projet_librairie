<?php ob_start()?>
ici le contenu de ma page listant les livres
<?php
//$content récupère le contenu du buffer
$content = ob_get_clean();
$titre = "Les livres de la bibliothèque";// variable récupérée dans le template pour afficher le titre de la page
require "template.php";
?>
