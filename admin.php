<?php
/**
 * page d'adiministration
 * @author afjnik hassan
 */
require("inc/functions.php");

/**
 * si pas identifier revoi au login
 */
if(!isLoggedIn()) {
    header("Location: login.php");
}

/**
 * Si authentifier comme client on le redirige
 */
if(!isAdmin()) {
    header("Location: index.php");
}

include("templates/header.php");

/**
 * gestion des pages d'admin
 */
if (isAdmin()) {
    if (!empty($_GET['pg'])) {
        $pg = $_GET['pg'];
        switch ($pg) {
            case 'produits':
                include('templates/admin-product.php');
                break;
            case 'clients':
                include('templates/admin-clients.php');
                break;
            case 'commandes':
                include('templates/admin-commandes.php');
            break;
            case 'edit':
                include('templates/admin-edit-product.php');
            break;
            default:
               echo "Bienvenue, maître";

                break;
        }
    }
}

include("templates/footer.php");


 ?>
