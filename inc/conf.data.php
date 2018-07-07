<?php
/**
 * fournisser les routine de connexion a mysql
 * et renomer le fichier en data.php
 * @author afjnik hassan
 */



/**
 * param connexion BDD
 */
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "";

/**
 * se connecter a mysql
 */
try {
    $db_connect = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=utf8",$user,$pass);
    $db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	die('Erreur : '.$e->getMessage());
}

/**
 * list de tout les produits
 * @return array
 */
function getAllProducts() {
    global $db_connect;
    $sql = "SELECT * FROM products
            ORDER BY id DESC";
    $query = $db_connect->query($sql);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}

/**
 * liste de toutes les commandes de tout les clients (admin panel)
 * @return array
 */
 function getAllOrder(){
     global $db_connect;
     $sql ='SELECT clients.first_name, clients.last_name, carts.id, sum(cart_lines.quantity)  as quantity
            FROM clients
            LEFT JOIN carts
            ON carts.client_id = clients.id
            LEFT JOIN cart_lines
            ON cart_lines.cart_id = carts.id
            WHERE clients.id = carts.client_id
            GROUP BY cart_lines.cart_id';

    $sth = $db_connect->prepare($sql);
    $sth->execute();

    return $sth->fetchAll(PDO::FETCH_ASSOC);
 }

/**
 * recuper un produit par sont id
 * @param  integer
 * @return array
 */
function getProduct($id) {
    global $db_connect;

    $sql = "SELECT * FROM products WHERE id = :id";
    $query = $db_connect->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $product = $query->fetch(PDO::FETCH_ASSOC);

    return $product;
}

/**
 * connaitre le groupe d'un utilisateur
 * @param  string
 * @return string
 */
function getGroupId($name) {
    global $db_connect;
    $sql = 'SELECT id FROM groups WHERE name LIKE "' . $name . '"';
    $req = $db_connect->query($sql);
    $res = $req->fetchColumn(0);
    return $res;
}

/**
 * ajouter un nouveau client
 * @param  array $_post
 * @return boolean
 */
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

/**
 * trouver un user avec sont email
 * @param  string $email [e-mail utilisateur]
 * @return array
 */
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

/**
 * verifier le mot de passe user
 * @param  integer $id [id client]
 * @return array
 */
function verifPassword($id){
    global $db_connect;
    $sql = "SELECT password
            FROM clients
            WHERE id=:id";
    $query = $db_connect->prepare($sql);
    $query->bindValue(':id', $id);
    $query->execute();

    $res = $query->fetch(PDO::FETCH_ASSOC);
    return  $res;
}

/**
 * trouver un utilisateur avec sont id
 * @param  integer $id [id user]
 * @return array
 */
function getUser($id) {
	global $db_connect;
    $sql = 'SELECT clients.* , groups.name as group_name
            FROM clients, groups
            WHERE clients.group_id = groups.id
            AND clients.id = :id';
	$query = $db_connect->prepare($sql);
	$query->bindValue(':id', $id);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);

	return $result;
}

/**
 * liste de tout les users
 * @return array
 */
function getAllUsers(){
    global $db_connect;
    $sql = 'SELECT clients.id, clients.first_name, clients.last_name, clients.address, clients.zipcode, clients.city, clients.phone, clients.email , groups.name
            FROM clients
            LEFT JOIN groups
            on clients.group_id = groups.id';

    $all = $db_connect->prepare($sql);
     $all->execute();
    return $all->fetchALL(PDO::FETCH_ASSOC);
}


/**
 * mise a jour d'un profile
 * @param  array $data [array des donne profile]
 * @return boolean
 */
function updateProfile($data){
    try
   {

       global $db_connect;
       $sql =  'UPDATE clients
               SET     first_name= :first_name,
                       last_name= :last_name,
                       address= :address,
                       zipcode= :zipcode,
                       city= :city,
                       phone= :phone,
                       email= :email,
                       password= :password
               WHERE id= :id';
       $update = $db_connect->prepare($sql);

       $update->bindValue(':first_name', $data['first_name'], PDO::PARAM_STR);
       $update->bindValue(':last_name', $data['last_name'], PDO::PARAM_STR);
       $update->bindValue(':address', $data['address'], PDO::PARAM_STR);
       $update->bindValue(':zipcode', $data['zipcode'], PDO::PARAM_STR);
       $update->bindValue(':city', $data['city'], PDO::PARAM_STR);
       $update->bindValue(':phone', $data['phone'], PDO::PARAM_STR);
       $update->bindValue(':email', $data['email'], PDO::PARAM_STR);
       $update->bindValue(':password', password_hash($data['password'], PASSWORD_DEFAULT) , PDO::PARAM_INT);
       $update->bindParam(':id', $data['id'], PDO::PARAM_INT);

       $update->execute();
       return true;
   }
       catch(Exception $e)
   {
       return false;
   }
}

/**
 * enregistrer un panier
 * @param  integer $id   [id cuser]
 * @param  array $cart [array panier]
 * @return boolean
 */
function saveCartForUser($id, $cart) {
    global $db_connect;
	$sql = 'INSERT INTO carts (client_id)
            VALUES (:clientId)';
    $query = $db_connect->prepare($sql);
    $query->bindValue(':clientId', $id);
    $query->execute();

    // Get last iserted id
    // http://php.net/manual/fr/pdo.lastinsertid.php
    $cartId = $db_connect->lastInsertId();

    $sql = 'INSERT INTO cart_lines (cart_id, product_id, quantity)
            VALUES (:cartId, :productId, :quantity)';



    $query = $db_connect->prepare($sql);
    $query->bindValue(":cartId", $cartId, PDO::PARAM_INT);
    $query->bindParam(":productId", $prodId, PDO::PARAM_INT );
    $query->bindParam(":quantity", $lineQt, PDO::PARAM_INT );

    foreach ($cart as $productId => $line) {
        $prodId = $productId;
        $lineQt = $line["qt"];
        $query->execute();
    }

}


/**
 * recuperer le panier d'un client
 * @param  integer $clientId [id user]
 * @return array
 */
function getClientCarts($clientId) {
    global $db_connect;
    $results = [];
	  $sql        =  'SELECT id FROM carts WHERE client_id = :clientId';
    $linesSql   =  'SELECT cart_lines.*, products.title, products.promo_price
                    FROM cart_lines, products
                    WHERE cart_lines.product_id = products.id
                    AND cart_id = :cartId';

    $cartsQuery = $db_connect->prepare($sql);
    $cartsQuery->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $cartsQuery->execute();

    $linesQuery = $db_connect->prepare($linesSql);
    $linesQuery->bindParam(':cartId', $cartId, PDO::PARAM_INT);

    while($clientCart = $cartsQuery->fetch()) {
        $cartId = $clientCart["id"];
        $linesQuery->execute();
        $cartLines = $linesQuery->fetchAll(PDO::FETCH_ASSOC);
        $results[$cartId] = $cartLines;
    }
    return $results;
}

/**
 * recuperer la liste des categories
 * @return array
 */
function getCategories(){
    global $db_connect;
    $sql = 'SELECT *
            FROM categories';
    $cat = $db_connect->query($sql);

    return $cat->fetchAll(PDO::FETCH_ASSOC);

}

/**
 * mise a jour d'un produit
 * @param  array $data [$_post[]]
 * @return boolean
 */
function updateProduct($data){
     try
    {
        global $db_connect;
        $sql =  'UPDATE products
                SET     title= :title,
                        price= :price,
                        promo_price= :promo,
                        picture= :image,
                        thumbnail= :thumbnail,
                        short_desc= :short_desc,
                        long_desc= :long_desc,
                        category_id= :categorie
                WHERE id= :id';
        $update = $db_connect->prepare($sql);

        $update->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $update->bindValue(':price', $data['price'], PDO::PARAM_STR);
        $update->bindValue(':promo', $data['promo'], PDO::PARAM_STR);
        $update->bindValue(':image', $data['picture'], PDO::PARAM_STR);
        $update->bindValue(':thumbnail', $data['thumbnail'], PDO::PARAM_STR);
        $update->bindValue(':short_desc', $data['short_desc'], PDO::PARAM_STR);
        $update->bindValue(':long_desc', $data['long_desc'], PDO::PARAM_STR);
        $update->bindValue(':categorie', $data['categorie'], PDO::PARAM_INT);
        $update->bindParam(':id', $data['id'], PDO::PARAM_INT);

        $update->execute();
        return true;
    }
        catch(Exception $e)
    {
        return false;
    }
}

/**
 * inserer un produit
 * @param  array $data [array $_post]
 * @return boolean
 */
function insertProduct($data){
    global $db_connect;
    $label  = ['title', 'price', 'promo_price', 'thumbnail', 'picture', 'short_desc', 'long_desc', 'category_id'];
    $bind   = [':title', ':price', ':promo_price', ':thumbnail', ':picture', ':short_desc', ':long_desc', ':category_id'];
    $labelsql = implode(', ', $label);
    $bindsql = implode(', ', $bind);

    $sql = "INSERT INTO products ( $labelsql )
            VALUE ( $bindsql )";
    $insert = $db_connect->prepare($sql);

    foreach ($label as $key => $value) {
        $insert->bindValue($bind[$key], $_POST[$value], PDO::PARAM_STR);
    }

    if ($insert->execute()){
        return true;
    } else
    {
        return false;
    }

}
?>
