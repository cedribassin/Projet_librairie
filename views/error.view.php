<?php ob_start()?>

<?= $msg ?>

<?php
$content = ob_get_clean();
$titre = "Gestion des erreurs";
require "template.php";
?>