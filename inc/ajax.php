<?php
/**
 * Rourine ajax
 * @author afjnik hassan
 */

 include('functions.php');

/**
* verification si y une requet a étais envoyé
* et la traiter
*/

if (isAjax()) {
    if (isLoggedIn()) {
        if (isAdmin()) {
          if ($action = $_POST['act']) {
            switch ($action) {
              case 'getProductInfo':
                  $arr = getProduct($_POST['id']);
                  $arr['price'] = getDisplayAmount($arr['price'] );
                  $arr['promo_price'] = getDisplayAmount($arr['promo_price'] );
                  echo json_encode($arr);
                  break;

              default:
                  # code...
                  break;
            }
          } else {
            sendError();
          }
        } // end ifs
    }
}
?>
