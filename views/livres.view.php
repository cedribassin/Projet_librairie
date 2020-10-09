<?php 
require_once "models/Livre.class.php";

// On retire cette partie pour la placer dans LivresController.controller.php
/* require_once "LivreManager.class.php";
$livreManager = new LivreManager; => dans le constructeur
$livreManager->recupLivresBdd();  => dans le constructeur
 */
ob_start();
if(!empty($_SESSION['alert'])):?>
    <div class="alert alert-<?= $_SESSION['alert']['type']?>" role="alert">
        <?= $_SESSION['alert']['msg']?>
    </div>
<?php endif; ?>

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
        <!-- On rajoute un lien pour les titre qui donne accès au livre sélectionné -->
        <td class="align-middle"><a href="<?=URL?>livres/l/<?= $livres[$i]->getId();?>"> <?= $livres[$i]->getTitre() ?></td>
        <td class="align-middle"><?= $livres[$i]->getNbPage() ?></td>
        <td class="align-middle"><a href="<?=URL?>livres/m/<?= $livres[$i]->getId();?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <!-- On déclare un form qui aura pour action de s'ouvrir sur l'url qui suit contenant l'id du livre à supprimer
             , on complète avec une confirmation du clique en soumission avec une fonction JS confirm() -->
            <form method="POST" action="<?=URL?>livres/s/<?= $livres[$i]->getId();?>" onSubmit="return confirm('voulez-vous vraiment supprimer le livre ?')";>
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php } ?>

</table> 
<!--d-block permet d'avoir le bouton Ajouter sur toute la ligne-->
<a href="<?= URL ?>livres/a" class="btn btn-success d-block">Ajouter</a>

<?php
//$content récupère le contenu du buffer
$content = ob_get_clean();
$titre = "Les livres de la bibliothèque";// variable récupérée dans le template pour afficher le titre de la page
require "template.php";
?>
