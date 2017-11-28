<main class="tile is-ancestor">
	<div class="tile is-vertical is-parent is-5">
		<div class="tile is-child">
    		<img  class="image thumbnail" src="images/<?= $product["picture"] ?>" alt="">
		</div>
	</div>
	<div class="tile is-vertical is-parent">
		<div class="tile is-child">
			<p class="title">
				<?= $product["title"] ?>
			</p>
			<div>
				<div class="field is-grouped is-grouped-multiline">
					<div class="control">
						<div class="tags has-addons">
							<?php if($product["price"] == $product["promo_price"]): ?>
								<span class="tag is-info"><?= getDisplayAmount($product["promo_price"]) ?></span>
							<?php else: ?>
								<span class="tag del"><?= getDisplayAmount($product["price"]) ?></span>
								<span class="tag is-info"><?= getDisplayAmount($product["promo_price"]) ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="control">

					</div>
				</div>
			</div>
			<div class="desc">
				<p class="has-text-justified"><?= $product["long_desc"] ?></p>
			</div>
			<div>
			<form action="cart.php" method="post">
							<input
								type="hidden"
								name="product-index"
								value="<?= $product["id"] ?>"
							/>
							<button type="submit" class="button is-pulled-right is-info">
								<span class="icon is-small">
									<i class="fa fa-cart-plus"></i>
								</span>
								<span>Ajouté au panier</span>
							</button >
						</form>	

			</div>
		</div>
	</div>
</main>

