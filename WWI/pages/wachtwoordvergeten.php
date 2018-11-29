
<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>

<?php include(ROOT_PATH . "/includes/header.php"); ?>
<html>
    <body>
        <form method="post" action="send_link.php">
            <p>Enter Email Address To Send Password Link</p>
            <input type="text" name="email">
            <input type="submit" name="submit_email">
        </form>
    </body>
</html>


<?php
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
mail($email, "wachtwoord reset", "FROM: noreply@WWI.nl");
?>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>
