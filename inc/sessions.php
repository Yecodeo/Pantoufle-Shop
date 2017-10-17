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

    // pas de session_unset("cart") ... la fonction vide TOUTE la session
    // par contre unset($var [, $var2 ...]) permet de supprimer UNE (ou +) variable
    // unset($_SESSION["cart"]); // supprime juste la case "cart" du tableau $_SESSION
    // ici on ne l'utilise pas parce qu'on veut quand même que le tableau du panier existe
    // (même vide)
    // vider toute la session:
    // équivalent à considérer mon visiteur comme un nouveau visiteur
    // attention, si j'ai stocké autre chose que mon panier dans la session
    // ça va l'effacer aussi
    // session_unset();
    // ici pour que la suite du script se déroule bien
    // il faudra donc que je réinitialise un "panier vide"
    // $_SESSION["cart"] = [];
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
    return $_SESSION["user"]["group"] == "admin";
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
    //  "déconnecter" mon user mais conserver le contenu de son panier
    unset($_SESSION["user"]);

    // vide les variables de la session, garde la même session active (id de session ne change pas)
    // session_unset();

    // détruit la session (sur le serveur) plus d'id de session, le cookie est toujours dans le navigateur de l'utilisateur mais l'id ne correspond plus à aucune donnée sur le serveur
    //  vide le panier avec
    // session_destroy();
}

 ?>
