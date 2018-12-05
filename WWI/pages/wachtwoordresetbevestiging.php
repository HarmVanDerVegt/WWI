<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>
<?php include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/UserController.php";
?>



<h1>JAJA het is gelukt or <3</h1>
<?php
$ID = filter_input(INPUT_POST, "userID", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'wachtwoord', FILTER_SANITIZE_STRING);
$passwordCheck = filter_input(INPUT_POST, 'bevestig_wachtwoord', FILTER_SANITIZE_STRING);
if (isset($password) && isset($passwordCheck)) {
    if ($password != $passwordCheck) {
        print("<p>wachtwoorden komen niet overeen</p>");
    } else {
        resetPassword($ID, $password);
    }
}