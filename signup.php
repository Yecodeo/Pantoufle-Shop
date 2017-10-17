<?php

// accès BD et fonctions
require("inc/functions.php");

// On traite les données soumises dans le form
$errors = [];
$message = "";
// => si le form a été soumis
if(isset($_POST["signup"])) {
    // valider les données (contraintes)
    // champs doivent pas être vides
    if($_POST["firstName"] == "") {
        $errors[] = "Saisissez un prénom";
    }
    if($_POST["lastName"] == "") {
        $errors[] = "Saisissez un nom de famille";
    }
    // l'email doit être valide
    if(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Saisissez un email valide";
    }
    // password: 8 caractères minimum
    if(strlen($_POST["password"]) < 8) {
        $errors[] = "MDP sécurisé = 8 caractères minimum!";
    }
    // password == confirm
    if($_POST["password"] != $_POST["confirmPassword"]) {
        $errors[] = "MDP incohérents vérifiez votre saisie.";
    }

    // si la saisie est valide
    if(empty($errors)) {
        // on hache le mdp
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $clientData = [
            "firstName" => trim($_POST["firstName"]),
            "lastName" => trim($_POST["lastName"]),
            "email" => trim($_POST["email"]),
            "hash" => $hash
        ];
        $result = saveClient($clientData);

        if($result) {
            $_SESSION["messages"][] = "Vous êtes à présent inscrit !";
            // redirection
            header('Location: index.php');
        }
        else {
            $_SESSION["messages"][] = "Erreur lors de l'inscription";
        }
    }
}


include("templates/header.php");
include("templates/signup-form.php");
include("templates/footer.php");
