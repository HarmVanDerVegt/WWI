<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>
<?php include(ROOT_PATH . "/includes/header.php"); ?>

<div class="card mx-auto" style="width: 36rem;">
    <div class="card-body mx-auto">
        <div class="signup-form">
            <div class="form-group">
                Nieuwe wachtwoord:<input type="password" class="form-control" name="wachtwoord" placeholder="Nieuw Wachtwoord"
                       required="required">
            </div>
            <div class="form-group">
                Bevestig wachtwoord:<input type="password" class="form-control" name="bevestig_wachtwoord"
                       placeholder="Bevestig Wachtwoord" required="required"><br>
                <input style="width: 200px;" type="submit" class="btn btn-sample" value="Reset wachtwoord">
            </div>
        </div>
    </div>
</div>


<?php include_once ROOT_PATH . "/includes/footer.php"; ?>