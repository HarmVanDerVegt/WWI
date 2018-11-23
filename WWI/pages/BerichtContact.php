<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php"); ?>

<p><h3>Hartelijk dank voor uw bericht, kunnen we u verder helpen?</h3></p>
    <a href="\WWI\WWI\pages\index.php">Terug naar startpagina...</a>

<?php
mail("contact.wideworldimporters@gmail.com", filter_input(INPUT_POST, "onderwerp", FILTER_SANITIZE_STRING), filter_input(INPUT_POST, "bericht", FILTER_SANITIZE_STRING), "FROM: " . filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));


//footer includen
include(ROOT_PATH . "/includes/footer.php"); ?>