<?php

#header en controllers includen
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";

//$_SESSION["cart"] wordt gebruikt om te kijken hoeveel verschillende producten er in de winkelwagen zitten
//$_SESSION["hoeveelheid"] wordt gebruikt hoeveel eenheden er per product zijn geselecteerd
//$_SESSION["totaal"] is de totaalprijs van alle producten
//$i Is de ID van het product

#check of de winkelwagen leeg is
$check = 0;

#Product toevoegen
if (!empty ($_POST["add"])) {
    $i = filter_input(INPUT_POST, "add", FILTER_SANITIZE_STRING);
    $hoeveelheid = filter_input(INPUT_POST, "hoeveelheid", FILTER_SANITIZE_STRING);
    $_SESSION["cart"][$i] = $i;
    $_SESSION["hoeveelheid"][$i] = $hoeveelheid;
}

#verwijderen
if (!empty ($_GET["delete"])) {
    $i = filter_input(INPUT_GET, "delete", FILTER_SANITIZE_STRING);
    if (isset($_SESSION["cart"][$i])) {
        unset($_SESSION["cart"][$i]);
    }
}

#winkelwagen
if (isset($_SESSION["cart"])) {
    $check = 1;
    ?>
    <br>
    <!--tabel voor de winkelwagen-->
    <h2>Winkelwagen</h2>
    <table>
    <tr>
        <th>Product</th>
        <th width="10px">&nbsp;</th>
        <th>Productprijs</th>
        <th width="10px"></th>
        <th>Hoeveelheid</th>
        <th width="10px">&nbsp;</th>
        <th>Subtotaal</th>
        <th width="10px">&nbsp;</th>
        <th>Updaten</th>
        <th width="10px"></th>
        <th>Product verwijderen</th>
    </tr>
    <?php
    //        totaalprijs = 0
    $_SESSION["totaal"] = 0;

    //        nagaan hoeveel producten er in de winkelwagen zitten
    foreach ($_SESSION["cart"] as $i) {
        if ($_SESSION["hoeveelheid"][$i] > getStockItemHoldingByID($i)["QuantityOnHand"]) {
            ?>
            <meta http-equiv="refresh" content="=0;URL=error.php"/>
            <?php unset($_SESSION["cart"][$i]); ?>
        <?php } else {
            ?>
            <input type="hidden" value="<?php echo($i) ?>" name="add">

            <!--product ophalen-->

            <?php $product = getStockItemByID($i);
            $productvoorraad = getStockItemHoldingByID($i);
            $product_voorraad = $productvoorraad["QuantityOnHand"];
            $productNaam = $product["StockItemName"];

            if ($productNaam != "") {

                if (!isset($_SESSION["hoeveelheid"])) {
                    $_SESSION["hoeveelheid"] = [1];
                }

                // prijs ophalen

                if ($product["RecommendedRetailPrice"] != NULL) {
                    $productPrijs = $product["RecommendedRetailPrice"];
                } else {
                    $productPrijs = $product["UnitPrice"] * ($product["TaxRate"] / 100 + 1);
                }
                ?>
                <tr>
                    <!--productnaam, producthoeveelheid weergeven-->
                    <td><?php print($productNaam); ?></td>
                    <td width="10px">&nbsp;</td>
                    <td><?php print(number_format($productPrijs, 2)); ?></td>
                    <td width="10px"></td>
                    <td><input type="number" name="hoeveelheid" min="1" max="<?php print($product_voorraad) ?>"
                               value="<?php print($_SESSION["hoeveelheid"][$i]); ?>" required>
                    </td>
                    <td width="10px">&nbsp;</td>
                    <!--prijs weergeven-->
                    <td><?php echo("€" . number_format($productPrijs * $_SESSION["hoeveelheid"][$i], 2)); ?></td>
                    <td width="10px">&nbsp;</td>
                    <!--winkelwagen updaten-->
                    <td><input class="btn btn-sample" type="submit" value="Update winkelwagen"></td>
                    <td width="10px"></td>
                    <!--product verwijderen-->
                    <td><a class="fa fa-trash btn btn-danger" href="?delete=<?php echo($i); ?>"></a></td>
                </tr>
                <?php
                $_SESSION["totaal"] += $productPrijs * $_SESSION["hoeveelheid"][$i];
            }
            //            totaalprijs weergeven
        }
    }
        ?>
        <form method="post" action="Bestelling.php">
            <tr>
                <td colspan="7">Totaal : €<?php echo(number_format($_SESSION["totaal"], 2)); ?></td>
                <td colspan="5"></td>
                <?php if ($_SESSION["totaal"] > 0) { ?>
                    <td colspan="5"><input class="btn btn-sample" type="submit" value="Afrekenen"></td>
                <?php } ?>
            </tr>
        </form>
        </table>
    <?php
}
//winkelwagen is leeg bericht
if ($check == 0 || $_SESSION["totaal"] <= 0) {
    print("<h3>Uw winkelwagen is leeg!</h3><br>");
}
?>
<br>
<?php
//footer includen
include(ROOT_PATH . "/includes/footer.php"); ?>
