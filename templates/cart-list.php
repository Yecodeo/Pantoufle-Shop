
         <div class="notification is-success">
                <div class="columns">
                        <div class="column is-8">
                                <p class="title">
                                Votre panier
                                </p>
                        </div>
                </div>


        </div>
<main id="cart"  class="container">
    <?php if(isset($message)) : ?>
		<div class="alert alert-info">
        	<p><?= $message ?></p>
		</div>
    <?php endif; ?>

    <!-- // si le panier est vide <=> le tableau $cart sera vide -->
    <?php if(empty($cart)) : ?>
        <!-- alors affiche un message d'info -->
        <div class="notification is-warning">
            
            <p><i class="fa fa-shopping-cart icon is-large fa-2x" aria-hidden="true"></i>
Votre panier est vide! Allez faire un peu de shopping et revenez vite </p>        
        </div>
    <?php else : ?>
        <!-- alors affiche le panier -->
    	<table class="table is-fullwidth is-narrow">
    		<thead>
    			<tr>
    				<td class="has-text-weight-bold">Titre</td>
                    <td class="has-text-weight-bold">Quantité</td>
    				<td class="has-text-weight-bold	 has-text-centered">Prix U</td>
                    <td class="has-text-weight-bold has-text-centered">Total</td>
                    <td class="has-text-weight-bold has-text-centered">Supprimer</td>
    			</tr>
    		</thead>
    		<tbody>
            <?php foreach ($cart as $itemIndex => $item) : ?>
            <?php   $link = "product.php?index=". $itemIndex; ?>

    			<tr>
    				<td><a href="<?= $link ?>"><?= $item["title"] ?></a></td>
                    <td>
                        <form class="input-group" action="cart.php" method="post">
                            <div class="field has-addons">
                                <div class="control">
                                    <button class="button is-warning is-small" type="submit" name="product-remove">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <div class="control">
                                    <input
                                        type="hidden"
                                        name="product-index"
                                        value="<?= $itemIndex ?>"
                                    >
                                    <input
                                        type="text"
                                        class="input has-text-centered is-small"
                                        name="product-quantity"
                                        value="<?= $item["qt"] ?>"
                                    >
                                </div>
                                <div class="control">
                                <button  class="button is-warning is-small" type="submit" name="product-add">
                                    <i class="fa fa-plus"></i>
                                </button>
                                </div>
                            </div>
                        </form>
                    </td>
     				<!-- 12 000 000,45 -->
    	            <td class="has-text-centered"><?= getDisplayAmount($item["price"]) ?></td>
                    <td class="is-selected has-text-centered "><?= getDisplayAmount($item["qt"] * $item["price"]) ?></td>
                    <td>
                        <form class="" action="cart.php" method="post">
                            <input
                                type="hidden"
                                name="cart-item-index"
                                value="<?= $itemIndex ?>"
                            >
                            <button class="button is-danger" type="submit" name="cart-item-delete">
                                <i class="fa fa-times-circle"></i>
                            </button>
                        </form>
                    </td>
    			</tr>
            <?php endforeach; ?>
    		</tbody>
    		<tfoot>
    			<tr>
    				<td colspan=3 ></td>
    				<td class="is-selected has-text-centered has-text-weight-bold "><?= getDisplayAmount($total) ?></td>
    			</tr>
    		</tfoot>
    	</table>

        <form class="pull-right" action="cart.php" method="post">
            <!-- <input type="submit" class="btn" name="cart-empty" value="Vider le panier"> -->
            <!-- equivalent -->
            <button class="button is-warning is-hovered" type="submit" name="cart-empty" value="true">
                <span class="icon">
                    <i class="fa fa-eraser"></i>
                </span>
                <span>Vider le panier</span>
            </button>
            <?php if(isLoggedIn()) : ?>
                <button class="button is-success" type="submit" name="cart-save" value="true">
                <span class="icon">
                    <i class="fa fa-money"></i>
                </span>
                <span>Valider la commande</span>
                </button>
            <?php endif; ?>
        </form>
    <?php endif; ?>
</main>
