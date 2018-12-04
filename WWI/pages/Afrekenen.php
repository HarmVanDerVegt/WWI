<?php

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";

function GetPurchaseOrderID()
{
    //Initieert de database.
    $db = createDB();

    //Nieuwe orderID aanmaken
    $orderID = "SELECT max(PurchaseOrderID) +1 AS ID FROM PurchaseOrders";
    $MAXorderID = $db->query($orderID);
    $maxID = $MAXorderID->fetch_assoc();
    $db->close();
    return $maxID["ID"];
}

function GetPurchaseOrderlineID()
{
    //Initieert de database.
    $db = createDB();

    //Nieuwe orderID aanmaken
    $orderID = "SELECT max(PurchaseOrderlineID) +1 AS ID FROM PurchaseOrderlines";
    $MAXorderID = $db->query($orderID);
    $maxOrderlineID = $MAXorderID->fetch_assoc();
    $db->close();
    return $maxOrderlineID["ID"];
}

function InsertIntoPurchaseorders($maxID, $datum)
{
//Initieert de database.
    $db = createDB();

//Prepared de SQL statement.
    $sql = "INSERT INTO purchaseorders 
        (PurchaseOrderID,
         SupplierID,
         Orderdate, 
         DeliveryMethodID, 
         ContactPersonID,
         LastEditedBy,
         IsOrderFinalized, 
         LastEditedWhen)
        VALUES ($maxID,
                1,
                '$datum',
                1,
                1,
                1,
                1,
                '$datum')";

//Voert de statement uit.
    $result = $db->query($sql);

//Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
//Dit geeft dus maar één rij terug.
    $db->close();

    return $result;
}

function InsertIntoPurchaseorderlines($orderID, $orderlineID, $StockitemID, $productnaam, $productprijs, $datum)
{
//Initieert de database.
    $db = createDB();

//Geeft een error als de value geen int is.
    //$value = (int)$value;

//Prepared de SQL statement
    $sql = "INSERT INTO purchaseorderlines 
VALUES ($orderlineID, 
        $orderID, 
        $StockitemID,
        '1',
        '$productnaam',
        '1',
        '1',
        $productprijs,
        '$datum',
        '1',
        '1',
        '$datum')";

//Voert de statement uit.
    $result = $db->query($sql);

//Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
//Dit geeft dus maar één rij terug.
    $db->close();

    return $result;
}

$datum = date("Y/m/d");
$orderID = GetPurchaseOrderID();


foreach ($_SESSION["cart"] as $i) {
    for ($a = 0; $a < $_SESSION["hoeveelheid"][$i]; $a++) {
        $orderlineID = GetPurchaseOrderlineID();
        $productnaam = getStockItemByID($i)['StockItemName'];
        $productnaam = str_replace('"', "\\\"", $productnaam);
        $productID = $i;
        $hoeveelheid = $_SESSION["hoeveelheid"][$i];
        if (getStockItemByID($i)["RecommendedRetailPrice"] != NULL) {
            $productPrijs = getStockItemByID($i)["RecommendedRetailPrice"];
        } else {
            $productPrijs = $product["UnitPrice"] * ($pduct["TaxRate"] / 100 + 1);
        }
        InsertIntoPurchaseorders($orderID, $datum);
        InsertIntoPurchaseorderlines($orderID, $orderlineID, $productID, $productnaam, $productPrijs, $datum);
    }
}
?>

<h1>Uw bestelling is afgerond</h1>

<form action="BestelStatus.php" method="post">
    <input type="hidden" name="purchaseorderID" value="<?php print $orderID; ?>">
    <!--    <input type="hidden" name="purchaseorderlineID" value="--><?php //$orderlineID; ?><!--">-->
    <input type="submit" class="btn btn-sample" value="Bekijk uw bestelstatus">
</form>
