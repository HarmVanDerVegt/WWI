<?php
if (!defined('ROOT_PATH')) {
    include_once("../config.php");
}

include_once ROOT_PATH . "/controllers/databaseController.php";
include_once ROOT_PATH . "/controllers/userController.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/reviewController.php";

$debug = 0;
?>
<?php
include_once(ROOT_PATH . "/includes/header.php");

if (!defined('ROOT_PATH')) {
    include("../config.php");
}
if (($_SESSION['IsSystemUser']) <> 1 and $_SESSION['IsEmployee'] <> 1) {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=/WWI/WWI/pages/index.php\" />";
}

$stockitemID = filter_input(INPUT_GET, "StockItemID");




$sarray = getProductSpecificReviewByStockItemID($stockitemID);
echo "<br>";
print_r ($sarray);

?>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>