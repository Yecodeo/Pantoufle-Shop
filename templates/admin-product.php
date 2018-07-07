<?php
/**
 * listes des produits && ajoute de nouveau produit
 * @author afjnik hassan
 */

if(isAdmin()) :

?>

<?php
  if (!empty($_POST)){
      if(isset($_FILES) && !empty($_FILES['picture']['name'])){
          $dossier = 'images/';
          $file = basename($_FILES['picture']['name']);
          $new =  explode('.',$file);
          if (move_uploaded_file($_FILES['picture']['tmp_name'], $dossier . $file)) {
              ResizePic($dossier . $file ,$dossier . $new[0] . '_tn.' . $new[1] ,200,200, true);
              $_POST['picture'] = $file;
              $_POST['thumbnail'] =  $new[0] . '_tn.' . $new[1] ;
          }
       } else {
          $_POST['picture']   = 'pattern.jpg';
          $_POST['thumbnail'] =   'pattern_tn.jpg';
      }

      if (!insertProduct($_POST)){
          echo '<div class="notification is-danger">Produit non Enregistrer</div>';
      }
  }
  $categorie  = getCategories();
  $arr_produit = getAllProducts();
?>

  <div class="container-fluid">
    <div class="notification is-success">
      <div class="columns">
        <div class="column is-8">
          <p class="title">
            Gestionnaire de produit
          </p>
        </div>
        <div class="column">
          <button type="button" class="mdl button is-warning is-pulled-right">
                        <span class="icon is-small">
                            <i class="fa fa-file-o"></i>
                        </span>
                        <span>Ajouté un article</span>
                    </button>
        </div>
      </div>
    </div>
    <table class="table ">
      <div class="new-products"></div>
      <thead>
        <tr>
          <th class="has-text-weight-semibold has-text-centered">Title</th>
          <th class="has-text-weight-semibold has-text-centered">Déscription</th>
          <th class="has-text-weight-semibold has-text-centered">Prix</th>
          <th class="has-text-weight-semibold has-text-centered">Promotion</th>
          <th class="has-text-weight-semibold has-text-centered">Visualiser</th>
          <th class="has-text-weight-semibold has-text-centered">Modifier</th>
        </tr>
      </thead>
      <tbody>  <!-- list all products -->
        <?php  foreach ($arr_produit  as $key => $value) : ?>
        <tr>
          <td>
            <?= $value['title']?>
          </td>
          <td>
            <?= substr($value['short_desc'],0,70) ?>
          </td>
          <td class="has-text-weight-semibold has-text-centered">
            <?= getDisplayAmount($value['price'])?>
          </td>
          <td class="has-text-weight-semibold has-text-centered">
            <?= getDisplayAmount($value['promo_price']) ?>
          </td>
          <td>
            <?php $link = "product.php?index=". $value["id"]; ?>
            <a class="button is-primary btn-sm" href="<?= $link ?>">
              <span class="icon is-small">
                <i class="fa fa-eye"></i>
              </span>
              <span>Visualiser</span>
            </a>
          </td>
          <td>
            <a class="button is-success btn-sm" href="admin.php?pg=edit&id= <?= $value['id'] ?>">
              <span class="icon is-small">
                  <i class="fa fa-pencil-square-o"></i>
              </span>
              <span>Modifier</span>
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody> <!-- end list all products -->
    </table>
  </div>
  <div class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Nouveau produit</p>
        <button class="delete" aria-label="close"></button>
      </header>
      <!-- form -->
      <form method="post" action="admin.php?pg=produits" enctype="multipart/form-data">
        <section class="modal-card-body">
          <div class="columns">
            <div class="column is-6">
              <div class="field">
                <div class="control">
                  <input name="title" class="input" type="text" placeholder="Titre">
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <input name="price" class="input" type="text" placeholder="Prix">
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <input name="promo_price" class="input" type="text" placeholder="Prix Promotionnel">
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <div class="media">
                    <div class="media-content">
                      <div class="file is-info has-name">
                        <label class="file-label">
                          <input class="file-input" type="file" name="picture">
                          <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                          <span class="file-cta">
                            <span class="file-icon">
                              <i class="fa fa-upload"></i>
                            </span>
                            <span class="file-label">
                              Info file…
                            </span>
                          </span>
                            <span class="file-name"></span>
                        </label>
                      </div> <!-- end file -->
                    </div> <!-- end media-content -->
                    <div class="media-right"></div>
                  </div> <!-- end media -->
                </div> <!-- end control -->
              </div> <!-- end field -->
            </div> <!-- end column -->
            <div class="column">
              <div class="field">
                <div class="control">
                  <textarea name="short_desc" class="textarea" type="text" placeholder="Description court"></textarea>
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <textarea name="long_desc" class="textarea" type="text" placeholder="Description Longue"></textarea>
                </div>
              </div>
              <div class="field">
                <label class="label">Categorie</label>
                <div class="control">
                  <div class="select">
                    <select name="category_id">
                     <?php
                        foreach ($categorie as $key => $value) {
                        echo  '<option value="' .$value['id'] . '">'. ucfirst($value['name']) .'</option>';
                        }
                      ?>
                    </select>
                  </div> <!-- end select -->
                </div> <!-- end control -->
              </div> <!-- end field -->
            </div> <!-- end column -->
          </div>
        </section>
        <footer class="modal-card-foot">
          <button class="button is-info">
            <span class="icon is-small">
              <i class="fa fa-floppy-o"></i>
            </span>
            <span>Save changes</span>
          </button>
          <button class="button is-danger">
            <span class="icon is-small">
                <i class="fa fa-times-circle-o"></i>
            </span>
            <span>Cancel</span>
        </button>
        </footer>
      </form><!-- end form -->
    </div> <!-- end modal-card -->
  </div> <!-- end modal -->

  <?php endif; ?>

  <?php  if(!isAdmin()) {
    header("Location: index.php");
} ?>
