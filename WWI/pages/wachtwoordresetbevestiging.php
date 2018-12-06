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
            ?>
            <meta http-equiv="refresh" content="=0;URL=wachtwoordReset.php?token=<?php print$token;?>&userID=<?php print$ID;?>&error='wachtwoorden_komen_niet_overeen'"/>

        <?php } else {
            resetPassword($ID, $password); ?>
            <p>Uw wachtwoord is aangepast.</p>
            <a href="index.php">Ga terug naar de startpagina...</a>
            <?php
        }
    } else {
        <meta http-equiv="refresh" content="=0;URL=wachtwoordReset.php?token=<?php print$token;?>&userID=<?php print$ID;?>&error='wachtwoorden_moeten_ingevuld_zijn'"/>
    }
} else {
    ?>
    <meta http-equiv="refresh" content="=0;URL=error.php"/>
<?php } ?>

<?php include(ROOT_PATH . "/includes/footer.php"); ?>
