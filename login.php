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
    	// 2. je vérifie si le mot de passe saisi : $_POST["password"]
        // correspond au hash stocké en BD pour cet utilisateur
        $passwordIsValid = password_verify( $_POST["password"], $user["password"]);

        // si c'est ok = si l'utilisateur a fourni le bon mdp par rapport au hash stocké dans base
        if($passwordIsValid) {
    	       // 3. je stocke les infos de mon utilisateur en session
               rememberUserData($user);
               // => mon utilisateur est correctement authentifié
               // <=> "connecté"
               header("Location: index.php");
        }
    }
}
// AFFICHAGE
include("templates/header.php");
include("templates/login-form.php");
include("templates/footer.php");
