<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" xmlns:>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
include_once ROOT_PATH . "/controllers/databaseController.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";

// voegt header toe
include(ROOT_PATH . "/includes/header.php");


function getBestellingByPurchaseorderID($ID)
{
    return getRowByIntID("PurchaseorderID", "purchaseorders", $ID);
}

function getProductsByPurchaseorderID($ID)
{

    return getRowByForeignID($ID, "purchaseorders", "purchaseorderlines", "PurchaseOrderID", "PurchaseOrderID");
}

$array = getBestellingByPurchaseorderID(2033);
$productenarray = getProductsByPurchaseorderID(2033);
$totaal = 0;

?>

<div class="mx-auto" style="width: 36rem;">
    <p>Bestelling nummer: <?php print($array['PurchaseOrderID'] . " van " . $array['OrderDate']); ?></p><br>


    <?php
    $vandaag = date("Y/m/d");
    $morgen = date("Y/m/d", time() + 86400);
    if ($vandaag > $array['ExpectedDeliveryDate']) {
    ?>
    <i class="fa fa-cubes" style="font-size:50px;color: aqua"></i>
    <i class="fa fa-arrow-right" style="font-size:50px;color: aqua"></i>
    <i class="material-icons" style="font-size:60px;color: aqua">local_shipping</i>
    <i class="fa fa-arrow-right" style="font-size:50px;color: aqua"></i>
    <i class="fa fa-home" style="font-size:60px;color: aqua"></i><br>
    <p>Uw bestelling is bezorgd!</p><br>
    <p>De verwachte bezorgdatum was:
        <?php
        print("<b>" . $array['ExpectedDeliveryDate'] . "</b></p><br>");
        ?>

        <?php } elseif ($morgen == $array['ExpectedDeliveryDate']) {
        ?>
        <i class="fa fa-cubes" style="font-size:50px;color: aqua"></i>
        <i class="fa fa-arrow-right" style="font-size:50px;color: aqua"></i>
        <i class="material-icons" style="font-size:60px;color: aqua">local_shipping</i>
        <i class="fa fa-arrow-right" style="font-size:50px"></i>
        <i class="fa fa-home" style="font-size:60px"></i><br>
    <p>Uw bestelling is onderweg!</p><br>
    <p>De verwachte bezorgdatum is:
        <?php
        print("<b>" . $array['ExpectedDeliveryDate'] . "</b></p><br>");
        } else { ?>
        <i class="fa fa-cubes" style="font-size:50px;color: aqua"></i>
        <i class="fa fa-arrow-right" style="font-size:50px"></i>
        <i class="material-icons" style="font-size:60px">local_shipping</i>
        <i class="fa fa-arrow-right" style="font-size:50px"></i>
        <i class="fa fa-home" style="font-size:60px"></i><br>
    <p>Uw bestelling is nog in behandeling!</p><br>
    <p>De verwachte bezorgdatum is:
        <?php
        print("<b>" . $array['ExpectedDeliveryDate'] . "</b></p><br>");
        } ?>
</div>

<div class="mx-auto" style="width: 50rem;">

    <table class="table-striped table-sm">
        <tr class="table-primary">
            <th>Product</th>
            <th width="10px">&nbsp;</th>
            <th>Productprijs</th>
            <th width="10px"></th>
            <th>Hoeveelheid</th>
            <th width="10px">&nbsp;</th>
            <th>Subtotaal</th>
        </tr>

        <?php
        foreach ($productenarray as $product) {

            $productprijs = $product['ExpectedUnitPricePerOuter'];
            $productprijs = number_format($productprijs, 2);
            $hoeveelheid = 1;//$product['Quantity'];
            $subtotaal = number_format($productprijs * $hoeveelheid, 2);
            ?>

            <tr>
                <td><?php print(getStockItemByID($product["StockItemID"])["StockItemName"]); ?></td>
                <td width="10px">&nbsp;</td>
                <td><?php print("€" . $productprijs); ?></td>
                <td width="10px"></td>
                <td><?php print($hoeveelheid); ?></td>
                <td width="10px">&nbsp;</td>
                <!--prijs weergeven-->
                <td><?php echo("€" . $subtotaal); ?></td>
                <td width="10px">&nbsp;</td>
            </tr>
            <?php
            //            totaalprijs weergeven
            $totaal += $subtotaal;
        }
        ?>
        <tr>
            <td colspan="7">Totaal : €<?php echo(number_format($totaal, 2)); ?></td>
        </tr>
    </table>
</div>
<br>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>