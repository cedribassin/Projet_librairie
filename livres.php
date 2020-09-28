<?php 
require_once "Livre.class.php";
//Création des objets
$livre1 = new Livre(1, "Algorithmique selon H2PROG", 300, "algo.png");
$livre2 = new Livre(2, "Le virus informatique", 250, "virus.png");
$livre3 = new Livre(3, "JS Client VS JS Serveur", 275, "js.png");
$livre4 = new Livre(4, "Le Quebec", 350, "quebec.png");

ob_start()?>

<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de pages</th>
        <!-- colspan="2" permet de couper une colonne, ici en 2 partie -->
        <th colspan="2">Actions</th>
    </tr>
    <tr>
        <td class="align-middle"><img src="public/images/algo.png" alt="Couverture du livre d'algorithmique selon h2prog" style="max-height:150px"/></td>
        <td class="align-middle">Algorithmique selon H2PROG</td>
        <td class="align-middle">300</td>
        <td class="align-middle"><a href="" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle"><a href="" class="btn btn-danger">Supprimer</a></td>
    </tr>
    <tr>
        <td class="align-middle"><img src="public/images/virus.png" alt="Couverture du livre virus informatique" style="max-height:150px"/></td>
        <td class="align-middle">Le virus informatique</td>
        <td class="align-middle">250</td>
        <td class="align-middle"><a href="" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle"><a href="" class="btn btn-danger">Supprimer</a></td>
    </tr>
</table> 
<!--d-block permet d'avoir le bouton Ajouter sur toute la ligne-->
<a href="" class="btn btn-success d-block">Ajouter</a>




<?php
//$content récupère le contenu du buffer
$content = ob_get_clean();
$titre = "Les livres de la bibliothèque";// variable récupérée dans le template pour afficher le titre de la page
require "template.php";
?>
