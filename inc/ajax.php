<?php

// AJAX REQUEST 
/*
on verfie si y a quelque chose de poster
*/
include('functions.php');
if (isAjax()) {
    if (isLoggedIn()) {
        if (isAdmin()) {
          if ($action = $_POST['act']) {
            switch ($action) {
                    case 'getProductInfo':
                    // json_decode pour encoder en json avant de renvoyé le array de getProduct
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