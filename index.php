<?php
// traitements / données
/*
require : provoquera erreur php & pas d'affichage de la boutique
vs include : nous permet d'éxécuter / afficher tout de même la boutique
si on a pas d'articles / si on trouve pas le fichier qui contient les articles
_once : superflu car si on appelle 2 fois le script ça redéclare seulement la variable.
*/
require("inc/functions.php");

// présentation

$products = getAllProducts();


include("templates/header.php");
include("templates/product-list.php");
include("templates/footer.php");

?>
