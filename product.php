<?php
	/**
	 * Page de produit
	 * @author afjnik hassan
	 */
	require("inc/functions.php");


	/**
	 * verfie si l'id du produit est fournie $_GET()
	 */
	if(!isset($_GET["index"])) {
		header("Location: index.php");
	}


	/**
	 * variable tenant l'id du produit
	 */
	$index = $_GET["index"];

	/**
	 * récuperer le produit de la BDD
	 */
	$product = getProduct($index);

	/**
	 * si produit pas trouvé redirection
	 */
	if(!$product) {
		header("Location: index.php");
	}

	include("templates/header.php");
	include("templates/product-single.php");
	include("templates/footer.php");
?>
