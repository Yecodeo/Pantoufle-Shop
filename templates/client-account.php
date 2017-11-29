
<div class="notification is-success">
                <div class="columns">
                        <div class="column is-8">
                                <p class="title">
                                Votre compte
                                </p>
                        </div>
                </div>


        </div>
<div class="columns">
  <div class="column is-one-quarter">
    <nav class="panel">
        <p class="panel-heading">
            Mes informations 
            <a class="button is-warning is-hovered  is-small is-pulled-right" href="edit-profile.php?id=<?=$clientData["id"] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        </p>
         <div class="panel-block">
        <address>
            <div class="columns">
                <div  class="column is-2">
                     <i class="fa fa-user-o" aria-hidden="true"></i>
                </div>
                <div class="column is-11">
                     <?= ucfirst($clientData["first_name"]) ?> <?= $clientData["last_name"] ?>
                </div>
            </div>
            <div class="columns">
                <div  class="column is-2">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i> 
                </div>
                <div class="column is-11">
                    <div>
                        <?= empty($clientData["address"]) ? "Adresse non renseignée" : $clientData["address"] ?>
                    </div>
                    <div>
                        <?= ($clientData["zipcode"] != "") ? $clientData["zipcode"] : "Code postale non renseigné" ?>
                    </div>
                    <div>
                        <?= ($clientData["city"] != "") ? $clientData["city"] : "Ville non renseignée" ?>                   
                    </div>
                </div>
            </div>
            <div class="columns">
                <div  class="column is-2">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                </div>
                <div  class="column is-11">
                    <?= ($clientData["phone"] != "")? $clientData["phone"] : "Téléphone non renseigné" ?>
                </div>
            </div>
        </address>
        </div>
    </nav>
  </div>
  <div class="column">
  <?php foreach ($clientCarts as $cartId => $lines) : ?>
    
                <!-- afficher panier n° XX, une <table> -->
                <div class="tags has-addons">
                    <span class="tag is-dark">Panier</span>
                    <span class="tag is-info"><?= $cartId ?></span>
                </div>
                <table class="table is-narrow is-fullwidth">
                    <thead>
                        <tr>
                            <th class="has-text-centered">Articles</th>
                            <th class="has-text-centered">Quantité</th>
                            <th class="has-text-centered">Prix de l'unité</th>
                            <th class="has-text-centered">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- et pour chaque ligne du panier -->
                    <?php foreach ($lines as $line) : ?>
                    <?php $link = "product.php?index=".$line["product_id"]; ?>
 
                        <!-- ajouter une <tr> dans <table> -->
                        <tr>
                            <td class="td-title"><a href="<?= $link ?>"><?= $line["title"] ?></a>  </td>
                            <td class="td-quantity has-text-centered"><?= $line["quantity"] ?></td>
                            <td class="td-priceU has-text-centered"><?= getDisplayAmount(floatval($line["promo_price"])) ?></td>
                            <td class="td-priceT is-selected has-text-centered"><?= getDisplayAmount(floatval($line["quantity"] * $line["promo_price"])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                </table>
			<?php endforeach; ?>
  
  </div>
</div>
