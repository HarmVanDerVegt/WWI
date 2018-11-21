<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once(ROOT_PATH . "/includes/header.php");
?>

<!-- start zoekfunctie -->
<?php $Search = (filter_input(INPUT_GET, "Zoeken", FILTER_SANITIZE_STRING));

if (filter_input(INPUT_GET, "Zoeken", FILTER_SANITIZE_STRING) <> "") {
    $sarray = getStockItemsBySearchDetails($Search);
}
?>
<table class="table table-striped">

    <tr>
        <th>Naam</th>
        <th>Link</th>
    </tr>
    <tr>
        <?php
        if (empty($sarray)){
            print "Niks gevonden.";
        }
        if (!empty($sarray)){
            foreach($sarray as $item){ ?>
        <td><?php print $item["StockItemName"] ?></td>
        <?php print("<td>" . '<a href="/WWI/WWI/pages/category/product.php?productID=' . $item["StockItemID"] . '">Link</a></td>'); ?>
    </tr>
    <?php }
    } ?>
</table>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>