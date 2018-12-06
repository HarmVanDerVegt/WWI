<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>
<?php include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/UserController.php";
$ID = filter_input(INPUT_GET, "userID", FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_STRING);

//print $token;

$tokenValidity = checkRecoveryToken($token, $ID);
if ($tokenValidity) {
    ?>
    <div class="card mx-auto" style="width: 36rem;">
        <div class="card-body mx-auto">
            <form method="post" action="wachtwoordresetbevestiging.php">
            <div class="signup-form">
                <input type="hidden" name="userID" value="<?php echo $ID ?>">
                <input type="hidden" name="token" value="<?php echo $token ?>">
                <div class="form-group">
                    Nieuwe wachtwoord:<input type="password" class="form-control" name="wachtwoord"
                                             placeholder="Nieuw Wachtwoord"
                                             required="required">
                </div>
                <div class="form-group">
                    Bevestig wachtwoord:<input type="password" class="form-control" name="bevestig_wachtwoord"
                                               placeholder="Bevestig Wachtwoord" required="required"><br>
                    <input style="width: 200px;" type="submit" class="btn btn-sample" value="Reset wachtwoord">
                </div>
            </div>
            </form>
        </div>
    </div>
<?php } else { ?>
    <meta http-equiv="refresh" content="=0;URL=error.php"/>
<?php }

include_once ROOT_PATH . "/includes/footer.php"; ?>