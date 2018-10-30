<?php
include_once "../../config.php";
include ROOT_PATH . "/includes/header.php";
?>
Voor de query

<?php
include ROOT_PATH . "/controllers/colorController.php";
print_r(getColorByID(6));
?>

Na de query

<?php include ROOT_PATH . "/includes/footer.php";?>
