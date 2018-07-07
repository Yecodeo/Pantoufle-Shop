<?php
  /**
   * Rourine sessions
   * @author afjnik hassan
   */


  session_start();

  /**
   * vérifier si l'user a panier
   * @return boolean
   */
  function userHasCart() {
      return isset($_SESSION["cart"]);
  }

  /**
   * vider le panier
   * @return null
   */
  function emptyCart() {
      $_SESSION["cart"] = [];
  }

  /**
   * ajouter un produit au panier
   * @param null
   */
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

  /**
   * diminuer la quantité d'un produit
   * @param  integer $id id du produit
   * @return null
   */
  function removeOneProductFromCart($id) {
      // si le produit est bien dans mon panier
      if(isset($_SESSION["cart"][$id])){
          // diminuer la quantité de 1
          $_SESSION["cart"][$id]["qt"]--;
          // si la qt est nulle
          if($_SESSION["cart"][$id]["qt"] == 0) {
              // je supprime la ligne du panier
              unset($_SESSION["cart"][$id]);
          }
      }
  }

  /**
   * retirer un produit du panier
   * @param  integer $id [id du produit]
   * @return null
   */
  function removeProductFromCart($id) {
      unset($_SESSION["cart"][$id]);
  }

  /**
   * Renvoi le contenu du panier
   * @return array
   */
  function getCart() {
      return $_SESSION["cart"];
  }

  /**
   * somme total des produits
   * @return integer
   */
  function getCartTotal() {
      $total = 0;
      foreach ($_SESSION["cart"] as $item) {
      	$total += $item["price"] * $item["qt"];
      }
      return $total;
  }

  /**
   * quantité des produits dans le panier
   * @return integer
   */
  function getTotalitem()
  {
      $total = 0;
  	if (array_key_exists('cart', $_SESSION)) {
  			foreach ($_SESSION['cart'] as $value) {
  			$total += 1;
  		}
  	}
      return $total;
  }

   /**
    * se souvenir des info client et panier
    * @param  array $user [array utilisateur]
    * @return null
    */
  function rememberUserData($user) {
      $_SESSION["user"] = [
          "id" => $user["id"],
          "first_name" => $user["first_name"],
          "last_name" => $user["last_name"],
          "group" => $user["group_name"]
      ];
  }

  /**
   * est ce que l'user est authentifier ?
   * @return boolean
   */
  function isLoggedIn() {
      return isset($_SESSION["user"]);
  }

  /**
  * est ce que l'user est admin ?
   */
  function isAdmin() {
      if (isset($_SESSION["user"]["group"])){
          return $_SESSION["user"]["group"] == "admin";
      }
  }

  /**
   * avoir l'id user
   * @return integer
   */
  function getUserId() {
      return $_SESSION["user"]["id"];
  }

  /**
   * avoir le nom de l'user
   * @return string
   */
  function getUserFirstname() {
      return $_SESSION["user"]["first_name"];
  }


  /**
   * detruire la session user
   * @return null
   */
  function logUserOut() {
      unset($_SESSION["user"]);
  }
?>
