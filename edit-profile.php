<?php
require("inc/functions.php");

// gère la page de modification des infos de profil
// Un client (utilisateur authentifié/connecté)
// peut modifier les informations de SON propre profil

// si notre utilisateur n'est pas authentifié, il est redirigé vers la page login

// si le formulaire a été soumis == l'utilisateur a fait des modifs dans ses données de profil
// if(...) {
    // contrôler les données
    // ==> champs NOT NULL ne doivent pas être vides, type de l'email, que le zipcode est numérique

    // si il y a des erreurs => les ranger dans une variable pour pouvoir les afficher dans le template
    // s'il n'y a pas d'erreur:
        // appeler une fonction de data.php
        // qui enregistre les changements faits sur l'utilisateur
        // == dans la fonction (qu'il faudra écrire, il y aune requête de modification des données `UPDATE matable SET champ = XXX, champ2 = YYY, .... WHERE id = :id`)
// }

// récupérer les infos de cet utilisateur (celui qui est connecté)
//  il y a une fonction pour ça (dans `inc/sessions.php`)
$clientData = "à remplacer par la bonne fonction";

// affiche le formulaire de modif avec les infos de l'utilisateur dedans
include("templates/header.php");
include("templates/edit-profile-form.php");
include("templates/footer.php");
 ?>
