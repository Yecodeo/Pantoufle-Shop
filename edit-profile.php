<?php
  /**
   * Page d'edition de profile
   * @author afjnik hassan
   */
  require("inc/functions.php");

  /**
   * si pas loger => redirection
   */
  if (!isLoggedIn()){
      header('Location:login.php');
  }

  $clientData = "à remplacer par la bonne fonction";

  include("templates/header.php");
  include("templates/edit-profile-form.php");
  include("templates/footer.php");
?>
