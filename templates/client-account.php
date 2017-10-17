<main id="account" class="container">
    <h2>Mon compte</h2>
    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mes informations</h3>
                </div>
                <div class="panel-body">
                    <a class="btn btn-default pull-right" href="edit-profile.php">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <ul>
                        <li><?= $clientData["first_name"] ?></li>
                        <li><?= $clientData["last_name"] ?></li>
                        <li><?= (!empty($clientData["address"])) ? $clientData["address"] : "adresse non renseignée" ?></li>
                        <li><?= ($clientData["zipcode"] != "")? $clientData["zipcode"] : "zipcode non renseigné" ?></li>
                        <li><?= ($clientData["city"] != "")? $clientData["city"] : "ville non renseignée" ?></li>
                        <li><?= ($clientData["phone"] != "")? $clientData["phone"] : "tel non renseigné" ?></li>
                    </ul>
                </div>
            </div>
        </div>
		<div class="col-sm-9">
			<!-- afficher chaque panier -->
			<?php foreach ($clientCarts as $cartId => $lines) : ?>
                <!-- afficher panier n° XX, une <table> -->
                <p>Panier n° <?= $cartId ?></p>
                <table>
                    <thead>
                        <tr>
                            <th>article</th>
                            <th>qt</th>
                            <th>PU</th>
                            <th>total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- et pour chaque ligne du panier -->
                    <?php foreach ($lines as $line) : ?>
                        <!-- ajouter une <tr> dans <table> -->
                        <tr>
                            <td><?= $line["title"] ?></td>
                            <td><?= $line["quantity"] ?></td>
                            <td><?= getDisplayAmount(floatval($line["promo_price"])) ?></td>
                            <td><?= getDisplayAmount(floatval($line["quantity"] * $line["promo_price"])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
			<?php endforeach; ?>
		</div>
    </div>
</main>
