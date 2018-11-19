<?php

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";

#kijken of de winkelwagen leeg is
$check = 0;



#Product toevoegen
if (!empty ($_POST["add"])){
    $i = filter_input(INPUT_POST,"add", FILTER_SANITIZE_STRING);
    $qty = filter_input(INPUT_POST,"hoeveelheid", FILTER_SANITIZE_STRING);
    $_SESSION["cart"][$i] = $i;
    $_SESSION["qty"][$i] = $qty;
    echo("product toevoegen");
}

#verwijderen
if (!empty ($_GET["delete"])) {
    $i = filter_input(INPUT_GET,"delete", FILTER_SANITIZE_STRING);
    $qty = $_SESSION["qty"][$i];
    $_SESSION["qty"][$i] = $qty;
    $_SESSION["amounts"][$i] = 0;
    unset($_SESSION["cart"][$i]);
    echo("product verwijderen");
}


#winkelwagen
if (isset($_SESSION["cart"])) {
    $check = 1;
    ?>

    <h2>Winkelwagen</h2>
    <table>
        <tr>
            <th>Product</th>
            <th width="10px">&nbsp;</th>
            <th>Hoeveelheid</th>
            <th width="10px">&nbsp;</th>
            <th>Subtotaal</th>
            <th width="10px">&nbsp;</th>
            <th>Updaten</th>
            <th width="10px"> </th>
            <th>Product verwijderen</th>
        </tr>
        <?php
        $total = 0;

        foreach ($_SESSION["cart"] as $i) {
            ?>
            <form method="post" action="ShoppingCart.php">
                <input type="hidden" value="<?php echo($i) ?>" name="add">
                <?php $product = getStockItemByID($i);
                $productvoorraad = getStockItemHoldingByID($i);
                $product_voorraad = $productvoorraad["QuantityOnHand"];
                $productNaam = $product["StockItemName"];
                 if ($product["RecommendedRetailPrice"] != NULL) {
                    $productPrijs = $product["RecommendedRetailPrice"];
                } else {
                    $productPrijs = $product["UnitPrice"] * ($product["TaxRate"] / 100 + 1);
                }
                print($product_voorraad);
                ?>
                <tr>
                    <td><?php print($productNaam); ?></td>
                    <td width="10px">&nbsp;</td>
                    <td><input type="number" name="hoeveelheid" min="1" max="<?php print($product_voorraad) ?>" value="<?php print($_SESSION["qty"][$i]); ?>" required>
                    </td>
                    <td width="10px">&nbsp;</td>
                    <td><?php echo("€" . $productPrijs * $_SESSION["qty"][$i]); ?></td>
                    <td width="10px">&nbsp;</td>
                    <td><input class="btn btn-sample"   type="submit" value="Update winkelwagen"></td>
                    <td width="10px"></td>
                    <td><a  class="fa fa-trash btn btn-danger" href="?delete=<?php echo($i); ?>"></a></td>
                </tr>
            </form>
            <?php
            $total += $productPrijs *
                $_SESSION["qty"][$i];
        }
        ?>
        <tr>
            <td colspan="7">Totaal : €<?php echo($total); ?></td>
        </tr>
    </table>
<?php } ?>

<?php
if ($check == 0) {
    print("<h3>Uw winkelwagen is leeg!</h3><br>");
}else{
    ?>
    <!--Afrekenen knop-->
    <tr>
        <td colspan="5"></td>
    </tr>
    <tr>
        <td colspan="5"><input class="btn btn-sample"   type="submit" value="Afrekenen"></td>
    </tr>
<?php }


include(ROOT_PATH . "/includes/footer.php"); ?>
