<?php
require("inc/functions.php");


// TRAITEMENT DE L'AUTHENTIFICATION D'UN USER
 
// 0. si le formulaire de login a été soumis
if(isset($_POST["login"])) {
	// 1. je récupère l'user
    // qui a l'email saisi : $_POST["email"]
	// s'il existe bien

    $user = getUserFromEmail($_POST["email"]);
    if($user) {
        $passwordIsValid = password_verify( $_POST["password"], $user["password"]);
        if($passwordIsValid) {
               rememberUserData($user);
               header("Location: index.php");
        } else {
            $message = 'Vérifier votre mot de passe !';            
        }
    } else {
        $message = 'Utilisateur ou email introuvable !';
    }
}
// AFFICHAGE
include("templates/header.php");
include("templates/login-form.php");
include("templates/footer.php");
