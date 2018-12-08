<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/UserController.php";
?>
    <body>
    <?php
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $emailcontrole = filter_input(INPUT_GET, 'emailControle', FILTER_SANITIZE_EMAIL);
    if ($email != $emailcontrole) {
        print("<p>Er is iets fout gegaan, volg nog een keer de link in de mail die u ontvangen heeft.</p>");
    } else {
        $ID = getUserByLogOnName($email);
        if (empty($ID)) {
            print("<meta http-equiv=\"refresh\" content=\"0;URL=wachtwoordvergeten.php\" />");
        } ?>
        <div>
            <h2>Bekijk uw mailbox</h2>
            <h3>Heeft u geen mail ontvangen? Bekijk uw spam</h3>
            <a href=\WWI\WWI\pages\index.php>Terug naar startpagina...</a>
        </div>
        <?php
        $token = md5(uniqid(mt_rand(), true));
        insertRecoveryToken($token, $ID);
        mailRecoveryToken($token, $email, $ID);
    }
    ?>
    </body>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>