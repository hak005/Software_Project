<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["UserId"]=null;/*!<Resetting the session user id before logout*/
$_SESSION["UserName"]=null;/*!<Resetting the session username before logout*/
$_SESSION["AdminName"]=null;/*!<Resetting the session username before logout*/
session_destroy();
Redirect_to("Login.php");
?>
