$(document).ready(function() {


  $('.view').click(function(e) {
    /* 
    on récuper l'id préalablement generer par le php
    on lisant l'attribut data-id 
    */
    var pid = $(this).attr('data-id');
    /* 
     ce n'est que une variable ou on stock le nom de
     l'action a effectué par php via ajax 
     voir admin-produit.php
    */
    var act = 'getProductInfo';
    /* requete ajax */
    $.ajax({
      /*
    les fichier php qui traite les requete ajax
    est dans data.php
     */
      url: 'inc/ajax.php',
      type: 'post',
      /* 
        on stock dans date un url du type 
        act=getProductInfo&id=41 
        vu que la requete est en POST
       */
      data: 'act=' + act + '&id=' + pid,

      /*
           les donnée renvoyé par php sont stock dans datas
           sous la forme de json vu que peut choisir le format de renvoi
           http://api.jquery.com/jquery.ajax/  voir la section datatype 
           on a le choix sur le format avec le quel on veut bosser
            */
      datatype: 'json',

      /*
        ici en met ajoute le modal de bootstrap 
        avec images et text reçu par le server
       */
      success: function(datas, status) {
        /* 
        initialisation du json avant usage sinon on un 
        un jolie undefined type
         */
        var json = $.parseJSON(datas);
        /*
          mise a jour des éléments html
         */
        $('.title').text(json.title);
        $('.price').text(json.price);
        $('.promo').text(json.promo_price);
        $('.desc').text(json.short_desc);
        $('.desc_long').text(json.long_desc);

        $('.product_img').css('background-image', 'url(images/' + json.thumbnail) + ')';
        /*
         Afficher le modal donc le code html est dans 
        admin-produit.php
         */
        $('#showup').modal();
      },
      error: function(result, status, error) {
        alert('il y a eu une erreur ' + error)
      }
    });



  });

});