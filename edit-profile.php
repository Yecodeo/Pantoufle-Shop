<?php
require("inc/functions.php");

if (!isLoggedIn()){
    header('Location:login.php'); 
}

$clientData = "à remplacer par la bonne fonction";

// affiche le formulaire de modif avec les infos de l'utilisateur dedans
include("templates/header.php");
include("templates/edit-profile-form.php");
include("templates/footer.php");
 ?>
