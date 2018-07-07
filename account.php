<?php
/**
 * Gestion du compte utilisateur
 * @author afjnik hassan
 */
require("inc/functions.php");

/**
 * vérifier si user authentifier
 */
if(!isLoggedIn()) {
    header("Location: login.php");
}

/**
 * Récuperation des données de l'user
 */
$id = getUserId();
$clientData = getUser($id);

/**
 * Lister toutes les commandes du client
 */
 $clientCarts = getClientCarts($id);

include("templates/header.php");
include("templates/client-account.php");
include("templates/footer.php");
