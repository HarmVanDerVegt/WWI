<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>
<?php include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/UserController.php";

$ID = filter_input(INPUT_POST, "userID", FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_POST, "token", FILTER_SANITIZE_STRING);
$tokenValidity = checkRecoveryToken($token, $ID);

$password = filter_input(INPUT_POST, 'wachtwoord', FILTER_SANITIZE_STRING);
$passwordCheck = filter_input(INPUT_POST, 'bevestig_wachtwoord', FILTER_SANITIZE_STRING);

if ($tokenValidity) {
    if (isset($password) && isset($passwordCheck)) {
        if ($password != $passwordCheck) {
            print("<p>Er is iets fout gegaan, volg nog een keer de link in de mail die u ontvangen heeft.</p>");
        } else {
            resetPassword($ID, $password); ?>
            <p>Uw wachtwoord is aangepast.</p>
            <a href="index.php">Ga terug naar de startpagina...</a>
            <?php
        }
    } else {
        print("<p>Er is iets fout gegaa, volg nog een keer de link in de mail die u ontvangen heeft.</p>");
    }
} else {
    print("<p>Er is iets fout gegaa, volg nog een keer de link in de mail die u ontvangen heeft.</p>");
} ?>

<?php include(ROOT_PATH . "/includes/footer.php"); ?>
