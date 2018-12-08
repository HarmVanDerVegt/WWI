<?php
function GetPurchaseOrderID()
{

    $db = createDB();

    //Haal de max plus 1 op om een ongebruikte ID op te vragen.
    $orderID = "SELECT max(PurchaseOrderID) +1 AS ID FROM PurchaseOrders";

    $MAXorderID = $db->query($orderID);

    $maxID = $MAXorderID->fetch_assoc();

    $db->close();

    return $maxID["ID"];
}

function GetPurchaseOrderlineID()
{
    $db = createDB();

    //Haal de max plus 1 op om een ongebruikte ID op te vragen.
    $orderID = "SELECT max(PurchaseOrderlineID) +1 AS ID FROM PurchaseOrderlines";

    $MAXorderID = $db->query($orderID);

    $maxOrderlineID = $MAXorderID->fetch_assoc();

    $db->close();

    return $maxOrderlineID["ID"];
}

function InsertIntoPurchaseorders($maxID, $datum, $bezorgdatum)
{
    $db = createDB();

    $sql = "INSERT INTO purchaseorders
(PurchaseOrderID,
SupplierID,
Orderdate,
DeliveryMethodID,
ContactPersonID,
LastEditedBy,
IsOrderFinalized,
LastEditedWhen,
ExpectedDeliveryDate)
VALUES ($maxID,
1,
'$datum',
1,
1,
1,
1,
'$datum',
'$bezorgdatum')";


    $result = $db->query($sql);

    $db->close();

    return $result;
}

function InsertIntoPurchaseorderlines($orderID, $orderlineID, $StockitemID, $productnaam, $productprijs, $datum)
{
    $db = createDB();

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

    $result = $db->query($sql);

    $db->close();

    return $result;
}


function getBestellingByPurchaseorderID($ID)
{
    return getRowByIntID("PurchaseorderID", "purchaseorders", $ID);
}

function getProductsByPurchaseorderID($ID)
{
    return getQuantityByPurchaseOrderID($ID, "purchaseorders", "purchaseorderlines", "PurchaseOrderID", "PurchaseOrderID");
}

function insertIntoPeoplePurchaseOrders($PersonID, $PurchaseOrderID)
{
    $db = createDB();

    $sql = "INSERT INTO peoplepurchaseorders 
            (PersonID, PurchaseOrderID) 
            VALUES ($PersonID, $PurchaseOrderID)";

    $result = $db->query($sql);

    $db->close();

    return $result;
}

function UpdateStock($productID, $hoeveelheid)
{
    $db = createDB();

    $sql = "UPDATE stockitemholdings
            SET QuantityOnHand = QuantityOnHand - " . $hoeveelheid . "
            WHERE StockItemID = " . $productID;

    $result = $db->query($sql);

    $db->close();

    return $result;
}

function getOrderByPersonID($PersonID)
{
    $db = createDB();

    $sql = "SELECT PurchaseOrderID
            FROM peoplepurchaseorders 
            WHERE PersonID = $PersonID";

    $result = $db->query($sql);

    $array = [];

    while ($row = $result->fetch_assoc()) {
        $array [array_values($row)[0]] = $row;
    }

    $db->close();

    return $array;
}