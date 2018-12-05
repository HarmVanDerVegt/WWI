<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");


if (NULL != (filter_input(INPUT_POST, 'voornaam', FILTER_SANITIZE_STRING)) &&
    NULL != (filter_input(INPUT_POST, 'achternaam', FILTER_SANITIZE_STRING)) &&
    NULL != (filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)) &&
    NULL != (filter_input(INPUT_POST, 'berich', FILTER_SANITIZE_STRING)) &&
    NULL != (filter_input(INPUT_POST, 'onderwerp', FILTER_SANITIZE_STRING))) {
    ?>
    <p><h3>Hartelijk dank voor uw bericht, kunnen we u verder helpen?</h3></p>
    <a href="\WWI\WWI\pages\index.php">Terug naar startpagina...</a>

    <?php
    mail("contact.wideworldimporters@gmail.com", filter_input(INPUT_POST, "onderwerp", FILTER_SANITIZE_STRING), filter_input(INPUT_POST, "bericht", FILTER_SANITIZE_STRING) . "FROM: " . filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING), "FROM: " . filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));


} else {
    ?>
    <a href="../pages/index.php"><h1>Er is helaas iets misgegaan, probeer het nog eens.</h1></a>
    <?php }


//footer includen
    include(ROOT_PATH . "/includes/footer.php"); ?>