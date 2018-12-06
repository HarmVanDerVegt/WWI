<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>
<?php include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/UserController.php";

$ID = filter_input(INPUT_GET, "userID", FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_STRING);
$tokenValidity = checkRecoveryToken($token, $ID);

$password = filter_input(INPUT_POST, 'wachtwoord', FILTER_SANITIZE_STRING);
$passwordCheck = filter_input(INPUT_POST, 'bevestig_wachtwoord', FILTER_SANITIZE_STRING);
if ($tokenValidity) {
    if (isset($password) && isset($passwordCheck)) {
        if ($password != $passwordCheck) {
            print("<p>wachtwoorden komen niet overeen</p>");
        } else {
            resetPassword($ID, $password); ?>
            <p>Uw wachtwoord is aangepast.</p>
            <a href="index.php">Ga terug naar de startpagina...</a>
            <?php
        }
    }
} else {
    ?>
    <meta http-equiv="refresh" content="=0;URL=error.php"/>
<?php } ?>