<?php

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";


function InsertIntoPurchaseorders($orderID, $datum)
{
//Initieert de database.
$db = createDB();

//Geeft een error als de value geen int is.
$value = (int)$value;

//Prepared de SQL statement.
$sql = "INSERT INTO purchaseorders 
        (PurchaseOrderID, SupplierID, Orderdate, DeliveryMethodID, ContactPersonID, LastEditedBy, IsOrderFinalized, LastEditedWhen)
        VALUES ($OrderID, 1, $datum, 1, 1, 1, 1, $datum)";


//Voert de statement uit.
$result = $db->query($sql);

//Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
//Dit geeft dus maar één rij terug.
$result = $result->fetch_assoc();
$db->close();

return $result;
}

function InsertIntoPurchaseorderlines($orderID, $orderlineID, $StockitemID, $productnaam, $productprijs, $datum)
{
//Initieert de database.
    $db = createDB();

//Geeft een error als de value geen int is.
    //$value = (int)$value;

//Prepared de SQL statement.
    $sql = "INSERT INTO purchaseorderlines 
VALUES ( $orderlineID, $orderID, $StockitemID, '1', $productnaam,
        '1', '1', $productprijs, $datum, '1', '6', $datum)";


//Voert de statement uit.
    $result = $db->query($sql);

//Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
//Dit geeft dus maar één rij terug.
    $result = $result->fetch_assoc();
    $db->close();

    return $result;
}


$orderID = 2077;
$orderlineID = 8368;

foreach($_SESSION["cart"] as $i){
$productnaam = filter_input(INPUT_POST, "productNaam", FILTER_SANITIZE_STRING);
$productID = filter_input(INPUT_POST, "productID", FILTER_SANITIZE_STRING);
$hoeveelheid = filter_input(INPUT_POST, "hoeveelheid", FILTER_SANITIZE_STRING);
$productprijs = filter_input(INPUT_POST, "productprijs", FILTER_SANITIZE_STRING);
$datum = date("Y/m/d");
$orderID++;
$orderlineID++;

InsertIntoPurchaseorderlines($orderID, $orderlineID, $productID, $productnaam, $productprijs, $datum);
InsertIntoPurchaseorders($orderID, $datum);

}
?>

<h1>Uw bestelling is afgerond</h1>
<h3>En als je dit leest ben je dik<3</h3>

<form action="BestelStatus.php">
    <input type="submit" name="Bekijk uw bestelstatus">
</form>
