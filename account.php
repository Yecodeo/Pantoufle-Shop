<?php
require("inc/functions.php");


/* Ce fichier gère la page "Mon Compte" d'un client
 *
 * Consignes générales:
 * - les accès à la base de données doivent se faire dans des fonctions, dans le fichier data.php
 * - la manipulation des sessions se fait dans des fonctions, dans le fichier sessions.php
 */

 // * Fonctionnement de la page:
 // * - si le client n'est pas authentifié, il doit être redirigé vers la page "login.php"
if(!isLoggedIn()) {
    header("Location: login.php");
}
// echo "je suis loggé";

 // * - s'il est authentifié, il faut
 // *     - récupérer ses informations complètes en base de données
$id = getUserId();
$clientData = getUser($id);

// appel de la fonction qui récupère toutes les commandes d'un client
$clientCarts = getClientCarts($id);

// echo "<pre>";
// print_r($clientCarts);
// echo "</pre>";

 /*     - les afficher en liste sur la page sous le forme:
 *         - Nom: ...
 *         - Prénom: ...
 *         - Adresse: ... / "non communiquée" (si l'adresse est vide)
 *         etc.
 */
include("templates/header.php");
include("templates/client-account.php");
include("templates/footer.php");
