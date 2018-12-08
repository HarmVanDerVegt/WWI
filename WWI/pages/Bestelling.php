<?php

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";
include_once ROOT_PATH . "/controllers/OrderController.php";
include_once ROOT_PATH . "/controllers/productController.php";


if ($_SESSION['IsSystemUser'] == 1) {
    if ($_SESSION["totaal"] < 1) {
        ?>
        <meta http-equiv="refresh" content="=0;URL=error.php"/>
    <?php } else {
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
            if ($_SESSION["hoeveelheid"][$i] > getStockItemHoldingByID($i)["QuantityOnHand"]) {
                ?>
                <meta http-equiv="refresh" content="=0;URL=error.php"/>
            <?php } else {
                //product ophalen
                $product = getStockItemByID($i);
                $productvoorraad = getStockItemHoldingByID($i);

                $product_voorraad = $productvoorraad["QuantityOnHand"];
                $productNaam = $product["StockItemName"];
                if ($productNaam != "") {

                    if (($i) != NULL) {
                        $productPrijs = generateDiscountPrice($product);
                    } else {
                        $productPrijs = $product["UnitPrice"] * ($product["TaxRate"] / 100 + 1);
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
            }
        }
    } ?>
    <tr>
        <td>Totaal : €<?php echo(number_format($_SESSION["totaal"], 2)); ?></td>
        <td></td>
        <td><input type="submit" <?php if ($_SESSION['IsEmployee'] == 1) {
                echo 'disabled';
            } ?> value="Verder met bestellen" class="btn btn-sample"></td>
    </tr>
    </form>
    </table>
    <?php
} else { ?>
    <h2>U kunt alleen bestellen als u bent ingelogd!</h2>
    <p>Heeft u al een account? Log dan eerst in</p>
    <p>Heeft u nog geen account? Registreer u dan hier:</p>
    <form action="Register.php">
        <input type="submit" class="btn btn-sample" value="Registreren">
    </form>

    <?php
}
?>

<?php include(ROOT_PATH . "/includes/footer.php"); ?>