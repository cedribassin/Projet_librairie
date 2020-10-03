<?php 
require_once "models/Livre.class.php";

// On retire cette partie pour la placer dans LivresController.controller.php
/* require_once "LivreManager.class.php";
$livreManager = new LivreManager; => dans le constructeur
$livreManager->recupLivresBdd();  => dans le constructeur
 */
ob_start()?>

<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de pages</th>
        <!-- colspan="2" permet de couper une colonne, ici en 2 partie -->
        <th colspan="2">Actions</th>
    </tr>
    <?php 
   /*  On retire cette partie pour la mettre dans LivresController.controller au niveau de la fonction
       afficherLivres()
   $livres=$livreManager->getLivres();//=> On récupère le tableau de $livre dans LivreManager 
   */
    for($i=0; $i<count($livres); $i++){
    ?>
    <tr>
        <td><img src="public/images/<?= $livres[$i]->getImage();?>" alt="<?=$livres[$i]->getTitre(); ?>" style="max-height:125px"/></td>
        <td class="align-middle"><?= $livres[$i]->getTitre() ?></td>
        <td class="align-middle"><?= $livres[$i]->getNbPage() ?></td>
        <td class="align-middle"><a href="" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle"><a href="" class="btn btn-danger">Supprimer</a></td>
    </tr>
    <?php } ?>

</table> 
<!--d-block permet d'avoir le bouton Ajouter sur toute la ligne-->
<a href="" class="btn btn-success d-block">Ajouter</a>

<?php
//$content récupère le contenu du buffer
$content = ob_get_clean();
$titre = "Les livres de la bibliothèque";// variable récupérée dans le template pour afficher le titre de la page
require "template.php";
?>
