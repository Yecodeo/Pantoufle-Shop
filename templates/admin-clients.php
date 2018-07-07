<?php
  /**
   * page list des clients
   * @author afjnik hassan
   */
  if(!isLoggedIn()) {
      header("Location: login.php");
  }
  if (!isAdmin()){
      header('Location: index.php');
  }
  $users = getAllUsers();
?>


<div>
    <div class="notification is-success">
        Gestionnaire de clients
    </div>
    <table class="table is-striped">
        <thead>
            <tr>
                <th class="has-text-weight-semibold has-text-centered">Nom</th>
                <th class="has-text-weight-semibold has-text-centered">Prénom</th>
                <th class="has-text-weight-semibold has-text-centered">Adresse</th>
                <th class="has-text-weight-semibold has-text-centered">Code postal</th>
                <th class="has-text-weight-semibold has-text-centered">Ville</th>
                <th class="has-text-weight-semibold has-text-centered">Téléphone</th>
                <th class="has-text-weight-semibold has-text-centered">E-mail</th>
                <th class="has-text-weight-semibold has-text-centered">Admin</th>
                <th class="has-text-weight-semibold has-text-centered">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key => $value) : ?>
                 <tr>
                        <td class="is-capitalized"><?= $value['first_name'] ?></td>
                        <td class="is-capitalized"><?= $value['last_name'] ?></td>
                        <td class="is-capitalized"><?= $value['address'] ?></td>
                        <td class="is-capitalized"><?= $value['zipcode'] ?></td>
                        <td class="is-capitalized"><?= $value['city'] ?></td>
                        <td class="is-capitalized"><?= $value['phone'] ?></td>
                        <td class="is-capitalized"><?= $value['email'] ?></td>
                        <td class="is-capitalized">
                            <i class="tag
                                <?php
                                   if  ($value['name'] == 'admin') {
                                        echo 'is-warning';
                                   } else {
                                    echo 'is-white';
                                   }
                                ?> is-medium"><?= $value['name'] ?></i>
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
