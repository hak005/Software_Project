<?php
session_start();

function ErrorMessage(){
  /*!\brief This function helps in formatting the error messages in case an error happened */
  if(isset($_SESSION["ErrorMessage"])){
    $Output = "<div class=\"alert alert-danger\">" ;
    $Output .= htmlentities($_SESSION["ErrorMessage"]);
    $Output .= "</div>";
    $_SESSION["ErrorMessage"] = null;
    return $Output;
  }
}
function SuccessMessage(){
  /*!\brief This function helps in formatting the success messages in case an operation succeeded */
  if(isset($_SESSION["SuccessMessage"])){
    $Output = "<div class=\"alert alert-success\">" ;
    $Output .= htmlentities($_SESSION["SuccessMessage"]);
    $Output .= "</div>";
    $_SESSION["SuccessMessage"] = null;
    return $Output;
  }
}

 ?>
