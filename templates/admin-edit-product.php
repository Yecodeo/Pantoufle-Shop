<?php
/**
 * edition d'un produit
 * @author afjnik hassan
 */
?>

<div class="notification is-success">
  <div class="columns">
    <div class="column is-8">
      <p class="title">
        Edition du produit
      </p>
    </div>

  </div>
</div>

<?php
/**
 * verifier si un produit est spécifier
 */
 if (isAdmin() && empty($_GET['id'])){
          echo '<div class="notification is-danger">
                  <span>
                    <i class="fa fa-exclamation fa-lg" aria-hidden="true"></i>
                  </span>
                  Produit non rensigner
                </div>';
        die;
}

?>

<?php if (isAdmin() && !empty($_GET['id'])) : ?>
<?php

    /**
     * valider les modification
     */
    if (!empty($_POST)) {
        if(isset($_FILES) && !empty($_FILES['picture']['name'])){
            $dossier = 'images/';
            $file = basename($_FILES['image']['name']);
            $new =  explode('.',$file);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $file)) {
                ResizePic($dossier . $file ,$dossier . $new[0] . '_tn.' . $new[1] ,200,200, true);
                $_POST['picture'] = $file;
                $_POST['thumbnail'] =  $new[0] . '_tn.' . $new[1] ;
            }
        } else
        {
            $current = getProduct($_POST['id']);
            $_POST['picture'] = $current['picture'];
            $_POST['thumbnail'] =  $current['thumbnail'];
        }

        $update = updateProduct($_POST);
        if ($update){
             echo '<div class="notification is-info"> <span><i class="fa fa-exclamation fa-lg" aria-hidden="true"></i>
            </span>Mise a jour  effectuée </div>';
        }
        else {
            echo '<div class="notification is-danger"> <span><i class="fa fa-exclamation fa-lg" aria-hidden="true"></i>
            </span>Mise a jour non effectuée </div>';
        }
    }

    if (!empty($_GET['id'])){
        $product = getProduct($_GET['id']);
    }

    if (!empty($_POST['id'])){
        $product = getProduct($_POST['id']);
    }

    $categorie = getCategories();
?>
<form method="post" action="admin.php?pg=edit&id=42" enctype="multipart/form-data">

  <div class="columns">
    <div class="column is-6">
      <div class="field">
        <label class="label">Titre</label>
        <div class="control">
          <input name="title" class="input" type="text" placeholder="Text" value="<?= $product['title'] ?>">
        </div>
      </div>
      <div class="field">
        <label class="label">Prix</label>
        <div class="control">
          <input name="price" class="input" type="text" placeholder="Text" value="<?= $product['price'] ?>">
        </div>
      </div>
      <div class="field">
        <label class="label">Prix Promotionnel </label>
        <div class="control">
          <input name="promo" lass="input" type="text" placeholder="Text" value="<?= $product['promo_price'] ?>">
        </div>
      </div>
      <div class="field">
        <div class="control">

          <div class="media">
            <figure class="media-left">
              <p class="image is-128x128">
                <img src="images\<?= $product['picture']?>">
              </p>
            </figure>
            <div class="media-content">
              <div class="contents">
                <div class="file is-warning has-name is-boxed">
                  <label class="file-label">
                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                            <input name="image" class="file-input" type="file">

                            <span class="file-cta">
                                <span class="file-icon">
                                <i class="fa fa-cloud-upload"></i>
                                </span>
                                <span class="file-label">
                                    Changer la photo
                                </span>
                            </span>
                            <span class="file-name">

                            </span>
                            </label>
                </div>
              </div>
            </div>
            <div class="media-right">

            </div>
          </div>

        </div>
      </div>

    </div>
    <div class="column">
      <div class="field">
        <div class="control">
          <label class="label">Description court</label>
          <textarea name="short_desc" class="textarea" type="text" placeholder="Normal textarea"><?= $product['short_desc']?></textarea>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <label class="label">Description Longue</label>
          <textarea name="long_desc" class="textarea" type="text" placeholder="Normal textarea"><?= $product['long_desc']?></textarea>
          <input type="hidden" name="id" value="<?= $product['id'] ?>">
        </div>
      </div>

      <div class="field">
        <label class="label">Subject</label>
        <div class="control">
          <div class="select">
            <select name="categorie">
                    <?php
                        foreach ($categorie as $key => $value) {
                            echo  '<option value="' .$value['id'] . '">'. ucfirst($value['name']) .'</option>';

                        }
                    ?>
                </select>
          </div>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <button class="button is-info ">
                <span class="icon">
                    <i class="fa fa-floppy-o"></i>
                </span>
                <span>Enregistrer</span>
                </button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php endif ?>
