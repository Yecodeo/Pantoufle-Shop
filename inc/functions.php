<?php
require('sessions.php');
require('data.php');

function getDisplayAmount($amount) {
    return number_format($amount , 2, ",", " ") . " €";
}

function isAjax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function sendError($message = "Erreur") {
  header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
  die($message);
}

function sanitize($str){
  return htmlspecialchars(strip_tags(trim($str)));
}
