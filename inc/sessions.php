<?php

// activer les sessions
session_start();

/********* GESTION DU PANIER *********/
/* j'ai besoin d'une variable qui va stocker le contenu de mon panier:
 $_SESSION["cart"]
 * Forme du panier:
 * 1 ligne = [index, title, price]
 *
*/
function userHasCart() {
    return isset($_SESSION["cart"]);
}

function emptyCart() {
    $_SESSION["cart"] = [];
}

function addOneProductToCart($product) {
    // est ce qu'on a déjà un prod identique dans le panier ?
    if(isset($_SESSION["cart"][$product["id"]])) {
        // incrémenter la qt demandée du produit $product["id"]
        $_SESSION["cart"][$product["id"]]["qt"]++;
    }
    else {
        // on enregistre l'ajout du produit dans le panier dans la session
        $_SESSION["cart"][$product["id"]] =  [
            // "index" => $product["id"],
            "title" => $product["title"],
            "price" => $product["promo_price"],
            "qt"    => 1
        ];
    }
}

function removeOneProductFromCart($id) {
    // si le produit est bien dans mon panier
    if(isset($_SESSION["cart"][$id])){

        // Je veux diminuer la quantité de 1 pour le produit concerné, dans le panier
        $_SESSION["cart"][$id]["qt"]--;

        // si la qt pour cet $id dans mon panier est nulle
        if($_SESSION["cart"][$id]["qt"] == 0) {
            // je supprime la ligne du panier
            unset($_SESSION["cart"][$id]);
        }
    }
}

function removeProductFromCart($id) {
    unset($_SESSION["cart"][$id]);
}

function getCart() {
    return $_SESSION["cart"];
}

function getCartTotal() {
    $total = 0;
    foreach ($_SESSION["cart"] as $item) {
    	$total += $item["price"] * $item["qt"];
    }
    return $total;
}

function getTotalitem()
{
    $total = 0;
    foreach ($_SESSION['cart'] as $value) {
        $total += 1;
    }
    return $total;
}

/********* GESTION DES UTILISATEURS *********/
/* j'ai besoin d'une variable (de session) pour stocker les infos relatives à l'utilisateur connecté
 $_SESSION["user"]
 * id
 * first_name
 * last_name

 Si mon utilisateur s'est identifié, il y a des valeurs dans $_SESSION["user"]
 Si l'utilisateur n'est pas identifié, $_SESSION["user"] est vide
*/

// remplir $_SESSION["user"] <==> "connecter mon utilisateur"
function rememberUserData($user) {
    $_SESSION["user"] = [
        "id" => $user["id"],
        "first_name" => $user["first_name"],
        "last_name" => $user["last_name"],
        "group" => $user["group_name"]
    ];
}

function isLoggedIn() {
    return isset($_SESSION["user"]);
}

function isAdmin() {
    if (isset($_SESSION["user"]["group"])){
        return $_SESSION["user"]["group"] == "admin";
    }
}

function isLogged(){
    if (isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id'])){
        return true;
    } else 
    {
        return false;
    }
}
function getUserId() {
    return $_SESSION["user"]["id"];
}

function getUserFirstname() {
    return $_SESSION["user"]["first_name"];
}

// "dé-authentifier" mon utilisateur <==> le "déconnecter" de l'application
// <==> vider les infos qui sont en session
function logUserOut() {
    unset($_SESSION["user"]);
}

 ?>
