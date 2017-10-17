<?php
require("inc/functions.php");

// cart: script qui va gérer l'ajout d'un produit dans le panier

// TRAITEMENT DES ACTIONS SUR LE PANIER
// REINIT PANIER
/* je (ré)initialise mon panier
- si il n'existe pas encore
- OU si je viens de recevoir l'ordre de le vider 'isset($_POST["cart-empty"])'
(si la variable $_POST["cart-empty"] existe
ça veut dire que c'est le formulaire qui contient
l'input name="cart-empty" qui a été soumis
= on veut vider le panier)
*/
if(!userHasCart() || isset($_POST["cart-empty"])){
    emptyCart();
	if(isset($_POST["cart-empty"])) {
        $message = "Vous venez JUSTE de vider le panier";
    }
}

// Ajout d'un produit au panier
/*
- j'ai aussi besoin des infos du produit à stocker
- quel est le produit que je veux ajouter?
<==> sur quel bouton on a cliqué? => je dois récupérer un index
$_GET["index"] ? Non, car on va faire une opération d'écriture (enregistrement sur le server), pas de lecture
DONC $_POST
*/

// si l'index du produit à ajouter a bien été envoyé en POST
if(isset($_POST["product-add"])) {
    // si la valeur est correcte
    // cad si le produit existe bien dans ma liste
    // id du produit qu'on veut ajouter : $_POST["product-index"]
    $productToAdd = getProduct($_POST["product-index"]);
    if($productToAdd) {
        // le produit qu'on veut ajouter au panier est valide
        // on l'ajoute au panier
        addOneProductToCart($productToAdd);
    }
}

// Enlever 1 à quantité d'un produit dans le panier
if(isset($_POST["product-remove"])) {
    // id du produit à diminuer : $_POST["product-index"]
    $productId = $_POST["product-index"];

    removeOneProductFromCart($productId);
}

/*
Suppression d'un élément du panier
si l'action demandée c'est cart-item-delete
=> supprimer la case cart-item-index du tableau $_SESSION["cart"]
*/
if(isset($_POST["cart-item-delete"])) {
    removeProductFromCart($_POST["cart-item-index"]);
}


// VALIDER LA commande = enregistrer le contenu du panier dans la BD comme nouveau panier pour cet utilisateur
if(isset($_POST["cart-save"])) {
    // - 1 récupérer le contenu du panier (stocké en session)
    $cart = getCart();
    // - 2 récupérer l'ID de l'utilisateur connecté
    $id = getUserId();

    // - 3 enregistre la commande en base de données pour cet utilisateur (il faut créer le panier dans la BD, et insérer chaque ligne!)
    saveCartForUser($id, $cart);

    // - 4 vide le panier en cours
    emptyCart();
    // - 5 affiche la page "Mon Compte" ==> redirection
    header("Location: account.php");
}

// MISE A DISPO DES VARIABLES POUR LE TEMPLATE

/* je range le contenu de mon panier (qui est stocké en session)
dans une variable $cart qui est ainsi disponible pour
être manipulée dans mon template cart-list
*/
$cart = getCart();
/* calcul du montant total de la commande */
$total = getCartTotal();

// fin des traitement du script,
// on passe à la présentation
include("templates/header.php");
include("templates/cart-list.php");
include("templates/footer.php");

?>
