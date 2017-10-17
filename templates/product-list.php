<main id="products" class="container">
    <?php
    foreach ($products as $index => $product) {
      $link = "product.php?index=".$product["id"];
    ?>
        <article class="product col-lg-3 col-sm-4 col-xs-12">
            <a class="product-link  col-xs-4 col-sm-12" href="<?= $link ?>">
              <h2 class="product-name"><?= $product["title"] ?></h2>
              <img class="product-image" src="images/<?= $product["thumbnail"] ?>" alt="<?= $product["short_desc"] ?>">
            </a>
			<div class="product-text col-xs-8  col-sm-12">
				<p class="product-desc"><?= $product["short_desc"] ?></p>
	            <p class="product-price">
	            <?php if($product["price"] == $product["promo_price"]): ?>
	                <span class="product-price-real"><?= getDisplayAmount($product["price"]) ?></span>
	            <?php else: ?>
	                <del class="product-price-old"><?= getDisplayAmount($product["price"]) ?></del>
	                <ins class="product-price-real"><?= getDisplayAmount($product["promo_price"]) ?></ins>
	            <?php endif; ?>
	            </p>
	            <p class="product-infos">
	                <a class="product-see" href="<?= $link ?>">
	                    <i class="fa fa-search" aria-hidden="true"></i>
	                    <span class="product-see-text">Voir le produit</span>
	                </a>
	                <form class="" action="cart.php" method="post">
	                    <input
	                        type="hidden"
	                        name="product-index"
	                        value="<?= $product["id"] ?>"
	                    >
	                    <input
	                        class="product-add col-xs-10 col-xs-offset-1"
	                        type="submit"
	                        name="product-add"
	                        value="Ajouter au panier"
	                    >
	                </form>
	            </p>
			</div>
        </article>
    <?php
    }
    ?>
</main>
