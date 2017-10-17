<main id="product" class="container">
	<div class="row">
    	<img id="product-image" class="col-sm-6 col-xs-4" src="images/<?= $product["picture"] ?>" alt="">
	    <div id="product-summary" class="col-sm-6 col-xs-8">
	        <h1 id="product-title" class="titre"><?= $product["title"] ?></h1>
	        <p id="product-price">
	            <?php if($product["price"] == $product["promo_price"]): ?>
	                <span class="product-price-real"><?= getDisplayAmount($product["price"]) ?></span>
	            <?php else: ?>
	                <del class="product-price-old"><?= getDisplayAmount($product["price"]) ?></del>
	                <ins class="product-price-real"><?= getDisplayAmount($product["promo_price"]) ?></ins>
	            <?php endif; ?>
	        </p>
	        <p id="product-short"><?= $product["short_desc"] ?>... <a id="product-link" href="#product-details">En savoir plus</a></p>

			<!-- bouton d'ajout au panier
			doit envoyer product-index en POST au script cart.php
			DONC il doit êter inclus dans un formulaire -->
			<form action="cart.php" method="post">
	            <!-- ce champ est de type "hidden", on ne le montre pas à l'utilisateur
	            et celui ci ne saisira rien dedans.
	            on utilise ce champ pour transmettre via POST une info supplémentaire:
	            l'index du produit qu'on veut ajouter au panier -->
	            <input
	                type="hidden"
					name="product-index"
					value="<?= $product["id"] ?>"
	            />
		        <input
					type="submit"
					id="product-add"
					class="product-add"
	                name="product-add"
	                value="Ajouter au panier"
				/>
			</form>

		</div>
	</div>
    <div id="product-details">
        <h2 class="product-detail titre">Détails</h2>
        <p id="product-desc"><?= $product["long_desc"] ?></p>
        <h2 class="product-detail titre">Prix</h2>
        <?php if($product["price"] == $product["promo_price"]): ?>
            <span class="product-price-real"><?= getDisplayAmount($product["price"]) ?></span>
        <?php else: ?>
            <del class="product-price-old"><?= getDisplayAmount($product["price"]) ?></del>
            <ins class="product-price-real"><?= getDisplayAmount($product["promo_price"]) ?></ins>
        <?php endif; ?>
    </div>
</main>
