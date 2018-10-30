<?php
include_once "../../config.php";
include ROOT_PATH . "/includes/header.php";
?>
Voor de query

<?php
include_once ROOT_PATH . "/controllers/colorController.php";
include_once  ROOT_PATH . "/controllers/stockItemController.php";
$item = getStockItemByID(6);

print_r($item["UnitPrice"]);
?>

Na de query

<?php include ROOT_PATH . "/includes/footer.php";?>
