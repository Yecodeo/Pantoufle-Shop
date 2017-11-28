
<main >

<div class="columns is-multiline">
<?php
    foreach ($products as $index => $product) {
		$link = "product.php?index=".$product["id"];
		?>
		
		<div class=" column is-one-quarter">
			<div class="card">
			<div class="card-image">
				<figure>
					<img class="image" height="300" width="300" src="images/<?= $product["thumbnail"] ?>" alt="Placeholder image">
				</figure>
			</div>
			<div class="card-content">
				<div class="media">
 
				<div class="media-content">
					<p class="title is-5 has-text-centered	"><a href="<?= $link ?>"><?= $product["title"] ?></a></p>
				</div>
				</div>
				<div class="contents">
					<p class="has-text-justified"><?= $product["short_desc"] ?></p>
					<div class="columns is-mobile is-centered">
						<div class="column is-half is-narrow">
							<span class="tag is-light del"> <?= getDisplayAmount($product["price"]) ?></span>
							<span class="tag is-info"><?= getDisplayAmount($product["promo_price"]) ?></span>
							
						</div>
					</div>
				</div>
				<footer class="card-footer">
					<div class="columns is-mobile is-centered">
						<div class="column is-half is-narrow">
						<form class="" action="cart.php" method="post">
								<input
									type="hidden"
									name="product-index"
									value="<?= $product["id"] ?>"
								>
								<button	class="button is-primary add" type="submit"	name="product-add"> 
									<i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp Ajouter au panier
								</button>
							</form>
							
						</div>
					</div>
 				</footer>
			</div>
			</div>
		</div>
		<?php
    }
    ?>
	</div>
</main>
