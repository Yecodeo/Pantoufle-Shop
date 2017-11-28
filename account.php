<?php
require("inc/functions.php");


/* Ce fichier gère la page "Mon Compte" d'un client
 *
 * Consignes générales:
 * - les accès à la base de données doivent se faire dans des fonctions, dans le fichier data.php
 * - la manipulation des sessions se fait dans des fonctions, dans le fichier sessions.php
 */

/**
 * Verifier si l'utilisateur est authentifier
 * sinon redirection a la page login
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
