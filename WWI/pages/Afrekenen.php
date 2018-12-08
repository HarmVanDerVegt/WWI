<?php

if (!defined('ROOT_PATH')) {
    include("../config.php");
}


include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";
include_once ROOT_PATH . "/controllers/OrderController.php";
include_once ROOT_PATH . "/controllers/productController.php";


$datum = date("Y/m/d");
$orderID = GetPurchaseOrderID();
$bezorgdatum = date("Y-m-d", time() + 1209600);
$PersonID = $_SESSION["USID"];

foreach ($_SESSION["cart"] as $i) {
    for ($a = 0; $a < $_SESSION["hoeveelheid"][$i]; $a++) {
        $orderlineID = GetPurchaseOrderlineID();
        $productnaam = getStockItemByID($i)['StockItemName'];
        $productnaam = str_replace('"', "\\\"", $productnaam);
        $productID = $i;
        $hoeveelheid = $_SESSION["hoeveelheid"][$i];
        if (getStockItemByID($i)["RecommendedRetailPrice"] != NULL) {
            $productPrijs = generateDiscountPrice($product = getStockItemByID($i));
        } else {
            $productPrijs = $product["UnitPrice"] * ($pduct["TaxRate"] / 100 + 1);
        }
        InsertIntoPurchaseorders($orderID, $datum, $bezorgdatum);
        InsertIntoPurchaseorderlines($orderID, $orderlineID, $productID, $productnaam, $productPrijs, $datum);
        insertIntoPeoplePurchaseOrders($PersonID, $orderID);
        UpdateStock($productID, 1);
    }
}

?>

<h1>Kies uw betaalmethode</h1>

<form action="welcome.php" method="post">
    <input type="submit" class="btn btn-sample" value="Ga door naar het proces na het betalen">
</form>
<form action="Mollie.php" method="post">
    <input type="hidden" name="purchaseorderID" value="<?php print $orderID; ?>">
    <input type="hidden" name="Totaalprijs" value="<?php print ($_SESSION["totaal"]); ?>">
    <input type="submit" class="btn btn-sample" value="Dummy Betalen">
</form>

<?php

unset($_SESSION["cart"]);
unset($_SESSION["hoeveelheid"]);
unset($_SESSION["totaal"]);
?>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>
