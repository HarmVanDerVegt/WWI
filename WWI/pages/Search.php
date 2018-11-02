<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include_once ROOT_PATH . "/controllers/databaseController.php";
include(ROOT_PATH . "/includes/header.php");
?>

<!-- start zoekfunctie -->
<?php $Search = (filter_input(INPUT_GET, "Zoeken", FILTER_SANITIZE_STRING));

if (filter_input(INPUT_GET, "Zoeken", FILTER_SANITIZE_STRING) <> "") {
    $sarray = getSEARCHInfo($Search);
    print_r($sarray);
    echo $sarray;
}
?>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>