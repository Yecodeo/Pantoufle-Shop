<?php $arr_produit = getAllProducts(); ?>
            
<div class="container table-responsive">
        <table class="table table-bordered ">
                <div class="new-products">
                        <button type="button" class="btn btn-info">
                                <i class="fa fa-file-o" aria-hidden="true"></i>
                                Ajouté un article
                        </button>
                </div>        
                <thead>
                        <tr>
                                <th>Title</th>
                                <th>Déscription</th>
                                <th>Prix</th>
                                <th>Promotion</th>
                                <th>Visualiser</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                        </tr>
                </thead>
                <tbody>
                        <?php 
                        foreach ($arr_produit  as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $value['title'] . '</td>';
                                echo '<td>' . substr($value['short_desc'],0,70) . '...</td>';
                                echo '<td>' . getDisplayAmount($value['price']) . '</td>';
                                echo '<td>' . getDisplayAmount($value['promo_price']) . '</td>';
                                echo '<td><button type="button" class="view btn btn-primary btn-sm"  data-id="'. $value['id'] .'">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Visualiser</button></td>';
                                echo '<td><button type="button" class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        Modifier</button></td>';
                                echo '<td><button type="button" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        Supprimer</button></td>';

                                echo '</tr>'; 
                        }   
                        ?>  
                </tbody>
        </table>
</div>

<div class="modal fade" id="showup" role="dialog">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="header modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="title"></h3>
                        </div>
                        <div class="modal-body">
                                <div class="container-fluid">
                                        <div class="row">
                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                        <div class="product_img"></div>
                                                </div>
                                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                        <div >
                                                                <span class="text-default">Prix</span>
                                                                <span class="price label label-default"></span>
                                                        </div>
                                                         <div >
                                                                <span class="text-default">Promotion</span>
                                                                <span class="promo label label-success"></span>
                                                        </div>
                                                        <div class="desc"></div>
                                        </div>
                                        <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <p class="desc_long">
                                                        </p>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        
                        <div class="modal-footer">
                               <button type="submit" class="btn btn-danger btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Quitter</button>
                        </div>
                </div>              
        </div>

</div>