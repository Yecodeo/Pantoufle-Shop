<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "drupal";

try {
	$db_connect = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=utf8",$user,$pass);
}

catch(PDOException $e) {
	die('Erreur : '.$e->getMessage());
}

/**** PRODUCTS ****/
function getAllProducts() {
    global $db_connect;

    $sql = "SELECT * FROM products";
    $query = $db_connect->query($sql);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}

function getProduct($id) {
    global $db_connect;

    $sql = "SELECT * FROM products WHERE id = :id";
    $query = $db_connect->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $product = $query->fetch(PDO::FETCH_ASSOC);

    return $product;
}

/**** USERS ****/
function getGroupId($name) {
    global $db_connect;
    $sql = 'SELECT id FROM groups WHERE name LIKE "' . $name . '"';
    $req = $db_connect->query($sql);
    $res = $req->fetchColumn(0);
    return $res;
}

function saveClient($clientData) {
    global $db_connect;

    $clientGroupId = getGroupId("client");

    // on enregistre les données en BD
    $sql = 'INSERT INTO clients (first_name, last_name, email, password, group_id)
            VALUES (:first_name, :last_name, :email, :password, ' . $clientGroupId . ')';

    $query = $db_connect->prepare($sql);
    $query->bindValue(':first_name', $clientData["firstName"]);
    $query->bindValue(':last_name', $clientData["lastName"]);
    $query->bindValue(':email', $clientData["email"]);
    $query->bindValue(':password', $clientData["hash"]);
    $result = $query->execute();

    return $result;
}

function getUserFromEmail($email) {
	global $db_connect;

    $sql = 'SELECT clients.* , groups.name as group_name
            FROM clients, groups
            WHERE clients.group_id = groups.id
            AND clients.email = :email';
	$query = $db_connect->prepare($sql);
	$query->bindValue(':email', $email);
	$query->execute();

	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function getUser($id) {
	// récupère la connexion à la BD (qui est une variable globale)
	global $db_connect;

	// va chercher toutes les infos du client dont l'id vaut $id
    $sql = 'SELECT clients.* , groups.name as group_name
            FROM clients, groups
            WHERE clients.group_id = groups.id
            AND clients.id = :id';
	// Hé, BDD, prépare moi une requête avec ce sql
	$query = $db_connect->prepare($sql);
	// Hé requête, la valeur du marqueur ":id" ce sera la valeur rangée dans la variable $id (quand tu va t'éxécuter)
	$query->bindValue(':id', $id);
	// Allez requête, t'as des valeurs pour tes marqueurs
	// éxécute toi
	$query->execute();

	// requête, donne moi ta première ligne de résultats
	// (sous forme d'un tableau associatif, index = noms des colonnes)
	$result = $query->fetch(PDO::FETCH_ASSOC);

	return $result;
}

/**** CARTS ****/
function saveCartForUser($id, $cart) {
    global $db_connect;

	// enregistre le panier d'un utilisateur:
	// 1. créer une ligne dans ma table `carts`
	//  avec comme valeur l'id du client correspondant
	$sql = 'INSERT INTO carts (client_id)
            VALUES (:clientId)';
    //  écriture == requete préparée
    // prepare
    $query = $db_connect->prepare($sql);
    // assoc. valeurs aux marqueurs
    $query->bindValue(':clientId', $id);
    //  execute
    $query->execute();
    // => si tout s'est bien passé, insertion d'une ligne, $res vaut 1
    // $res = $query->execute();

    // !! Pour enregistrer les lignes du panier,
    //    j'ai besoin de l'id de celui ci
    //  via une requête:
        // - je récupère celui-ci depuis la table carts
        //  -les paniers de l'utilisateur user_id:
        //   select id from carts where user_id = :user_id order by id desc limit 1
    //  OU
    // via la fonction adéquate de PDO
    // http://php.net/manual/fr/pdo.lastinsertid.php
    $cartId = $db_connect->lastInsertId();

	//  2. pour chacune des lignes du panier
	//   insérer une ligne dans la table `cart_lines`
	//   avec comme valeurs
	// 		- l'id du panier correspondant
	// 		- l'id du produit correspondant
	// 		- la quantité
    $sql = 'INSERT INTO cart_lines (cart_id, product_id, quantity)
            VALUES (:cartId, :productId, :quantity)';

    $query = $db_connect->prepare($sql);
    $query->bindValue(":cartId", $cartId, PDO::PARAM_INT);

    // quand j'appellerais execute, tu executera la requete avec les valeurs qui SERONT contenues dans les variables $prodId et $lineQt
    $query->bindParam(":productId", $prodId, PDO::PARAM_INT );
    $query->bindParam(":quantity", $lineQt, PDO::PARAM_INT );


    foreach ($cart as $productId => $line) {
        // je veux éxécuter la même requête d'insertion
        // mais avec des valeurs différentes pour chaque ligne de mon panier
        // les variables $prodId et $lineQt prennent les valeurs de la ligne du panier courante == celle qu'on est en train de traiter dans la boucle
        $prodId = $productId;
        $lineQt = $line["qt"];
        //  => j'éxécute la requête pour ces valeurs
        $query->execute();
    }

    // On veut éxécuter ces requêtes successivement
    //  (exemple d'un contenu de panier avec 3 articles)
    // INSERT INTO cart_lines (cart_id, product_id, quantity)
    //         VALUES ($cartId, 43, 1)
    // INSERT INTO cart_lines (cart_id, product_id, quantity)
    //         VALUES ($cartId, 42, 3)
    // INSERT INTO cart_lines (cart_id, product_id, quantity)
    //         VALUES ($cartId, 44, 1)
}

function getClientCarts($clientId) {
    global $db_connect;

    // initialisation du tableau de résultats
    $results = [];

    // récupère la liste des paniers du client.
	$sql = 'SELECT id FROM carts WHERE client_id = :clientId';

	// pour chaque panier, récupère la liste des lignes du panier.
    // En plus de l'id du produit et de la quantité, chaque ligne devra aussi comporter les informations dont on a besoin pour afficher le panier: le nom et le prix unitaire des produits
    $linesSql = 'SELECT cart_lines.*, products.title, products.promo_price
    FROM cart_lines, products
    WHERE cart_lines.product_id = products.id
    AND cart_id = :cartId';

    // executer requete de récup de la liste de  paniers
    $cartsQuery = $db_connect->prepare($sql);
    $cartsQuery->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $cartsQuery->execute();

    // prépare la requete de récup des lignes de paniers:
    $linesQuery = $db_connect->prepare($linesSql);
    $linesQuery->bindParam(':cartId', $cartId, PDO::PARAM_INT);

    // si on récupère tous les résultats de la requete dans un tableau
    // ensuite on le traite avec foreach
    // $cartIds = $cartsQuery->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($cartIds);
    // echo "</pre>";
    // foreach ($cartIds as $clientCart) {

    while($clientCart = $cartsQuery->fetch()) {
        // j'éxécute la requete qui récupère la liste de lignes du panier
        $cartId = $clientCart["id"];
        $linesQuery->execute();

        // je range le résultat de cette requête dans mon tableau de résultats
        $cartLines = $linesQuery->fetchAll(PDO::FETCH_ASSOC);

        $results[$cartId] = $cartLines;

    }


    // retourne l'ensemble des informations des paniers
    return $results;

    /* le tableau de résultat devra ressembler à:

    // $result = tableau, indexé par les id de paniers, car liste de paniers
    // $result = [
        // case du panier 2 contient une liste de lignes de ce panier => tableau
        2 => [
            // tableau qui représente une ligne de mon panier
            [ cart_id, prod_id, quantity, title, promo_price ],
            [ cart_id, prod_id, quantity, title, promo_price ],
            ...
        ],
        5 => [
            [ cart_id, prod_id, quantity, title, promo_price ],
            [ cart_id, prod_id, quantity, title, promo_price ],
            ...
        ],
    ]
    */
}




?>
