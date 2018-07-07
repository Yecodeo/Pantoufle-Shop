<?php
/**
 * Page du panier
 * @author afjnik hassan
 */
require("inc/functions.php");

/**
 * vider le panier
 */
if(!userHasCart() || isset($_POST["cart-empty"])){
    emptyCart();
	if(isset($_POST["cart-empty"])) {
        $message = "Vous venez JUSTE de vider le panier";
    }
}

/**
 * Ajout de produit au panier
 */
if(isset($_POST["product-add"])) {
    $productToAdd = getProduct($_POST["product-index"]);
    if($productToAdd) {
        addOneProductToCart($productToAdd);
    }
}

/**
 * diminuer la quantité d'un produit dans le panier
 */
if(isset($_POST["product-remove"])) {
    $productId = $_POST["product-index"];
    removeOneProductFromCart($productId);
}

/**
 * Supprissiond'un produit du panier
 */
if(isset($_POST["cart-item-delete"])) {
    removeProductFromCart($_POST["cart-item-index"]);
}

/**
 * enregister la commande en BDD
 */
if(isset($_POST["cart-save"])) {
    // - 1 récupérer le contenu du panier (stocké en session)
    $cart = getCart();
    // - 2 récupérer l'ID de l'utilisateur connecté
    $id = getUserId();
    // - 3 enregistre la commande en base de données pour cet utilisateur
    saveCartForUser($id, $cart);
    // - 4 vide le panier en cours
    emptyCart();
    // - 5 affiche la page "Mon Compte" ==> redirection
    header("Location: account.php");
}


/**
 * variable du contenu du panier pour les templates
 */
$cart = getCart();

/**
 * Montant total de la commande pour les templates
 */
$total = getCartTotal();

include("templates/header.php");
include("templates/cart-list.php");
include("templates/footer.php");

?>
