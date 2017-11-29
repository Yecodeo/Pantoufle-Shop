 
<?php 
if(!isLoggedIn()) {
    header("Location: login.php");
}
if (!isAdmin()){
    header('Location: index.php');
}
$orders = getAllOrder();
?>


<div>
<div class="notification is-success">
    Gestionnaire des commandes
</div>
<table class="table is-striped">
    <thead>
        <tr>
            <th class="has-text-weight-semibold has-text-centered">Nom</th>
            <th class="has-text-weight-semibold has-text-centered">Prénom</th>
            <th class="has-text-weight-semibold has-text-centered">Commande</th>
            <th class="has-text-weight-semibold has-text-centered">Nombre de produit</th>
            <th class="has-text-weight-semibold has-text-centered">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $key => $value) : ?>
             <tr>
                    <td class="is-capitalized has-text-centered"><?= $value['first_name'] ?></td>
                    <td class="is-capitalized has-text-centered"><?= $value['last_name'] ?></td>
                    <td class="is-capitalized has-text-centered"><?= $value['id'] ?></td>
                    <td class="is-capitalized has-text-centered ">
                        <span class="tag is-link">
                            <?= $value['quantity'] ?>
                        </span>
                    </td>

                    <td> 
                        <a class="button is-danger">
                            <span class="icon">
                            <i class="fa fa-trash-o"></i>
                            </span>
                            <span>Supprimer</span>
                        </a>
                    </td>
            </tr>
         <?php endforeach; ?>
    </tbody>
</table>
</div>
