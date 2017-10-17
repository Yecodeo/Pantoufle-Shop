<?php
require("inc/functions.php");

// Si l'index qui nous est fourni en param GET n'est pas fourni
if(!isset($_GET["index"])) {
	// on redirige vers l'accueil
	header("Location: index.php");
}

// Il nous faut l'info "quel produit?"
// Pour récupérer cette info depuis une autre page, on passe l'index
// du produit qu'on veut afficher dans un parametre GET dans l'URL
$index = $_GET["index"];

// Traitements
// Récupérer les données
// Ici: UN produit
$product = getProduct($index);

// Si il n'y a pas de produit qui correspond à cet index
// rien à afficher
if(!$product) {
	header("Location: index.php");
}

// Présentation
// C'est une page "normale" de ma boutique cad elle a un header et un footer
// appeler le template qui présente le détail d'un produit
include("templates/header.php");
include("templates/product-single.php");
include("templates/footer.php");
?>
