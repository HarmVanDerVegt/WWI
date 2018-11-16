<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link href="\WWI\WWI\css\button.css" rel="stylesheet" type="text/css"/>
    <link href="\WWI\WWI\css\register.css" rel="stylesheet" type="text/css"/>


    <!-- voegt header toe -->
<?php include(ROOT_PATH . "/includes/header.php"); ?>

<?php

echo ("Hallo ". $_SESSION["Voornaam"]." ". $_SESSION["achternaam"]." U kunt inlogen met ". $_SESSION["Email"]. " en het opgegeven wachtwoord." );
?>



<?php include(ROOT_PATH . "/includes/footer.php"); ?>
