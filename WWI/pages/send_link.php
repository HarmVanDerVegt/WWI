<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php"); ?>
    <html>
    <body>
    <?php
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $emailcontrole = filter_input(INPUT_GET, 'emailControle', FILTER_SANITIZE_EMAIL);
    if ($email != $emailcontrole) {
        print("<meta http-equiv=\"refresh\" content=\"0;URL=wachtwoordvergeten.php\" />");
    } else { ?>
        <div>
            <h2>Bekijk uw mailbox</h2>
            <h3>Heeft u geen mail ontvangen? Bekijk uw spam</h3>
            <a href=\WWI\WWI\pages\index.php>Terug naar startpagina...</a>
        </div>
        <?php $email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_EMAIL);
        mail($email, "wachtwoord reset", "FROM: noreply@WWI.nl");
    }


    ?>
    </body>
    </html>


<?php include(ROOT_PATH . "/includes/footer.php"); ?>