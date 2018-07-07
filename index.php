<?php
/**
 * Page d'edition de profile
 * @author afjnik hassan
 */

require("inc/functions.php");

/**
 * variable de tout les produits
 */
$products = getAllProducts();


include("templates/header.php");
include("templates/product-list.php");
include("templates/footer.php");

?>
