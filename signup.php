<?php

/**
 * Page d'inscription
 * @author afjnik hassan
 */
require("inc/functions.php");


$errors = [];
$message = "";

/**
 * traitement du Form d'inscription
 */
 if(isset($_POST["signup"])) {
    if($_POST["firstName"] == "") {
        $errors[] = "Saisissez un prénom";
    }
    if($_POST["lastName"] == "") {
        $errors[] = "Saisissez un nom de famille";
    }
    if(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Saisissez un email valide";
    }
    if(strlen($_POST["password"]) < 8) {
        $errors[] = "Le mot de passe doit étre de 8 caractères minimum!";
    }
    if($_POST["password"] != $_POST["confirmPassword"]) {
        $errors[] = "Mot de passe incohérents vérifiez votre saisie.";
    }

    /**
     * si pas d'erreur en trait l'inscription
     */
    if(empty($errors)) {
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $clientData = [
            "firstName" => trim($_POST["firstName"]),
            "lastName" => trim($_POST["lastName"]),
            "email" => trim($_POST["email"]),
            "hash" => $hash
        ];
        $result = saveClient($clientData);
        if($result) {
            header('Location: login.php');
        }
        else {
            $errors[] = "Erreur lors de l'inscription";
        }
    }
}


include("templates/header.php");
include("templates/signup-form.php");
include("templates/footer.php");
