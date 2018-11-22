<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include_once ROOT_PATH . "/includes/header.php";
include_once ROOT_PATH . "/controllers/productController.php";

$stockItem = getStockItemByID(42);

$combiDeals = generateCombiDeals($stockItem);

?>
<div class="row">
    <div class="col-lg-8">
        <div class="bg-light card">
            <h4>Combideals:</h4>
            <p> Misschien zijn deze producten een leuke combinatie met dit product? </p>
            <?php echo generateCombiDealCards($combiDeals); ?>
        </div>
    </div>
</div>
