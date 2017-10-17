<main id="cart"  class="container">
    <?php if(isset($message)) : ?>
		<div class="alert alert-info">
        	<p><?= $message ?></p>
		</div>
    <?php endif; ?>

    <!-- // si le panier est vide <=> le tableau $cart sera vide -->
    <?php if(empty($cart)) : ?>
        <!-- alors affiche un message d'info -->
		<div class="alert alert-info">
        	<p>Votre panier est vide! Allez faire un peu de shopping et revenez vite ^^</p>
		</div>
    <?php else : ?>
        <!-- alors affiche le panier -->
    	<h2>Votre panier:</h2>

    	<table class="table table-bordered table-hover">
    		<thead>
    			<tr>
    				<td>index</td>
    				<td>titre</td>
                    <td>quantité</td>
    				<td>prix U</td>
                    <td>total</td>
                    <td>supprimer</td>
    			</tr>
    		</thead>
    		<tbody>
            <?php foreach ($cart as $itemIndex => $item) : ?>
    			<tr>
    				<td><span class="badge"><?= $itemIndex ?></span></td>
    				<td><?= $item["title"] ?></td>
                    <td>
                        <form class="input-group" action="cart.php" method="post">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="product-remove">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </span>
                            <input
                                type="hidden"
                                name="product-index"
                                value="<?= $itemIndex ?>"
                            >
                            <input
                                type="text"
                                class="form-control product-quantity"
                                name="product-quantity"
                                value="<?= $item["qt"] ?>"
                            >
                            <span class="input-group-btn">
                                <button  class="btn btn-default" type="submit" name="product-add">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </form>
                    </td>
    				<!-- 12 000 000,45 -->
    	            <td><?= getDisplayAmount($item["price"]) ?></td>
                    <td><?= getDisplayAmount($item["qt"] * $item["price"]) ?></td>
                    <td>
                        <form class="" action="cart.php" method="post">
                            <input
                                type="hidden"
                                name="cart-item-index"
                                value="<?= $itemIndex ?>"
                            >
                            <button class="btn btn-default" type="submit" name="cart-item-delete">
                                <i class="fa fa-times-circle"></i>
                            </button>
                        </form>
                    </td>
    			</tr>
            <?php endforeach; ?>
    		</tbody>
    		<tfoot>
    			<tr>
    				<td colspan=4 >Total : </td>
    				<td><?= getDisplayAmount($total) ?></td>
    			</tr>
    		</tfoot>
    	</table>

        <form class="pull-right" action="cart.php" method="post">
            <!-- <input type="submit" class="btn" name="cart-empty" value="Vider le panier"> -->
            <!-- equivalent -->
            <button class="btn btn-warning" type="submit" name="cart-empty" value="true">Vider le panier</button>
            <?php if(isLoggedIn()) : ?>
                <button class="btn btn-success" type="submit" name="cart-save" value="true">Valider la commande</button>
            <?php endif; ?>
        </form>
    <?php endif; ?>
</main>
