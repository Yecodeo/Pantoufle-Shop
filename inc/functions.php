<?php
/**
 * Rourine sessions
 * @author afjnik hassan
 */

require('sessions.php');
require('data.php');

/**
 * retourn la somme
 * @param  integer
 * @return string
 */
function getDisplayAmount($amount) {
    return number_format($amount , 2, ",", " ") . " €";
}

/**
 * est ce que c'est une requete ajax
 * @return boolean
 */
function isAjax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * renvoyer une erreur a l'user
 * @param  string
 * @return null
 */
function sendError($message = "Erreur") {
  header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
  die($message);
}

/**
 * nettoyage d'une chaine
 * @param  string
 * @return string
 */
function sanitize($str){
  return htmlspecialchars(strip_tags(trim($str)));
}

/**
 * montre le contenu d'une variable
 */
function dump($data){
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
}

/**
 * redimensioner une photo
 * @param string  $img    [dossier]
 * @param string  $to     [nom du fichier]
 * @param integer $width  [largeur]
 * @param integer $height [hauteur]
 * @param boolean $useGD  [utiliser l'api GD]
 */
function ResizePic($img, $to, $width = 0, $height = 0, $useGD = TRUE){
   $dimensions = getimagesize($img);
   $ratio      = $dimensions[0] / $dimensions[1];

   // Calcul des dimensions si 0 passé en paramètre
   if($width == 0 && $height == 0){
     $width = $dimensions[0];
     $height = $dimensions[1];
   }elseif($height == 0){
     $height = round($width / $ratio);
   }elseif ($width == 0){
     $width = round($height * $ratio);
   }

   if($dimensions[0] > ($width / $height) * $dimensions[1]){
     $dimY = $height;
     $dimX = round($height * $dimensions[0] / $dimensions[1]);
     $decalX = ($dimX - $width) / 2;
     $decalY = 0;
   }
   if($dimensions[0] < ($width / $height) * $dimensions[1]){
     $dimX = $width;
     $dimY = round($width * $dimensions[1] / $dimensions[0]);
     $decalY = ($dimY - $height) / 2;
     $decalX = 0;
   }
   if($dimensions[0] == ($width / $height) * $dimensions[1]){
     $dimX = $width;
     $dimY = $height;
     $decalX = 0;
     $decalY = 0;
   }

   // Création de l'image avec la librairie GD
     $pattern = imagecreatetruecolor($width, $height);
     $type = mime_content_type($img);
     switch (substr($type, 6)) {
       case 'jpeg':
         $image = imagecreatefromjpeg($img);
         break;
       case 'gif':
         $image = imagecreatefromgif($img);
         break;
       case 'png':
         $image = imagecreatefrompng($img);
         break;
     }
     imagecopyresampled($pattern, $image, 0, 0, 0, 0, $dimX, $dimY, $dimensions[0], $dimensions[1]);
     imagedestroy($image);
     imagejpeg($pattern, $to, 100);

   return TRUE;
 }
