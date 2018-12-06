<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
include_once ROOT_PATH . "/controllers/databaseController.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/OrderController.php";


// voegt header toe
include(ROOT_PATH . "/includes/header.php");

$productenarray = getProductsByPurchaseorderID($OrderID);
foreach ($productenarray as $product) {
    $productprijs = $product['ExpectedUnitPricePerOuter'];
    $productprijs = number_format($productprijs, 2);
    $hoeveelheid = $product['Quantity'];
    $subtotaal = (float)number_format($productprijs * $hoeveelheid, 2);
    $totaal += $subtotaal;
}
$PersonID = $_SESSION["USID"];
$Orders = getOrderByPersonID($PersonID);

if (empty($Orders)) {
    print "<p>Er zijn geen bestellingen beschikbaar</p>";
} else {
    foreach ($Orders as $order) {
        ?>
        <?php
        $array = getBestellingByPurchaseorderID($order);
        print "<div class=\"card\">";
        print "Bestelling : <b>" . $order . "</b><br>";
        print "Besteld op : " . $array['OrderDate'] . "<br>";
        print "prijs : €" . $totaal . "<br>";
        ?>
        <form action="BestelStatus.php">
            <input type="hidden" value="<?php print $order; ?>" name="OrderID" "
            <input type="submit" class="btn btn-sample" value="Selecteren">
        </form>
        </div>
    <?php }
} ?>

<?php include(ROOT_PATH . "/includes/footer.php"); ?>
