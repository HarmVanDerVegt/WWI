<?php
include_once "../../config.php";
include ROOT_PATH . "/includes/header.php";
?>
Voor de query <br>

<?php
include_once ROOT_PATH . "/controllers/colorController.php";
include_once  ROOT_PATH . "/controllers/stockItemController.php";
$item = getStockItemByID(6);

echo "Naam: " . $item["StockItemName"] . "<br>";
echo "Prijs is: " . $item["UnitPrice"] . "<br>";
echo "Size is: " . $item["Size"] . "<br>";
;
?>

Na de query

<?php include ROOT_PATH . "/includes/footer.php";?>
