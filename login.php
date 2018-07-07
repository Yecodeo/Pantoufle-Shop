<?php
/**
 * Page d'authentification
 * @author afjnik hassan
 */
require("inc/functions.php");

/**
 * traitement du form login
 */
if(isset($_POST["login"])) {
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

include("templates/header.php");
include("templates/login-form.php");
include("templates/footer.php");
