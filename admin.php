<?php

require("inc/functions.php");

// - cette page ne s'affiche que si l'utilisateur est admin.

//   S'il n'est pas identifié, il est redirigé vers la page de login
if(!isLoggedIn()) {
    header("Location: login.php");
}

//   S'il est connecté en tant que client, il est redirigé vers la page d'accueil
if(!isAdmin()) {
    header("Location: index.php");
}
// echo "Bienvenue, maître";

include("templates/header.php");

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
