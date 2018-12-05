<?php

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";
include_once ROOT_PATH . "/controllers/OrderController.php";



if($_SESSION["totaal"] > 0){
?>
    <p>Zijn dit uw geselecteerde producten?<br>
        <b>Let Op!</b> U kunt uw producten hierna niet meer wijzigen.</p>
    <form action="ShoppingCart.php">
        <input type="submit" class="btn btn-sample" value="Terug naar de winkelwagen">
    </form>
    <table class="table-striped table-sm">
        <form action="Afrekenen.php" method="post">
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
            foreach ($_SESSION["cart"] as $i) {
                //product ophalen
                $product = getStockItemByID($i);
                $productvoorraad = getStockItemHoldingByID($i);

                $product_voorraad = $productvoorraad["QuantityOnHand"];
                $productNaam = $product["StockItemName"];
                if ($productNaam != "") {

                    if ($product["RecommendedRetailPrice"] != NULL) {
                        $productPrijs = $product["RecommendedRetailPrice"];
                    } else {
                        $productPrijs = $product["UnitPrice"] * ($pduct["TaxRate"] / 100 + 1);
                    }
                    ?>

                    <tr>
                        <td><?php print($productNaam); ?></td>
                        <td width="10px">&nbsp;</td>
                        <td><?php print(number_format($productPrijs, 2)); ?></td>
                        <td width="10px"></td>
                        <td><?php print($_SESSION["hoeveelheid"][$i]); ?></td>
                        <td width="10px">&nbsp;</td>
                        <!--prijs weergeven-->
                        <td><?php echo("€" . number_format($productPrijs * $_SESSION["hoeveelheid"][$i], 2)); ?></td>
                        <td width="10px">&nbsp;</td>
                    </tr>
                    <?php
                }
            } ?>
            <tr>
                <td>Totaal : €<?php echo(number_format($_SESSION["totaal"], 2)); ?></td>
                <td></td>
                <td><input type="submit" value="Verder met bestellen" class="btn btn-sample"></td>
            </tr>
        </form>
    </table>
<?php }else{ ?>
    <a href="../pages/index.php"><h1>Er is helaas iets misgegaan, probeer het nog eens.</h1></a>

    <?php
}


?>

    <!--footer includen-->
<?php include(ROOT_PATH . "/includes/footer.php"); ?>