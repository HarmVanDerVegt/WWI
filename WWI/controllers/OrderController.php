<?php
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

function InsertIntoPurchaseorders($maxID, $datum, $bezorgdatum)
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
    //Initieert de database.
    $db = createDB();

//Prepared de SQL statement
    $sql = "INSERT INTO peoplepurchaseorders 
            (PersonID, PurchaseOrderID) 
            VALUES ($PersonID, $OrderID)";

//Voert de statement uit.
    $result = $db->query($sql);

//Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
//Dit geeft dus maar één rij terug.
    $db->close();

    return $result;
}

function getOrderByPersonID($PersonID){
    //Initieert de database.
    $db = createDB();

//Prepared de SQL statement
    $sql = "SELECT PurchaseOrderID
            FROM peoplepurchaseorders 
            WHERE PersonID = $PersonID";

//Voert de statement uit.
    $result = $db->query($sql);

//Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
    $result = $result->fetch_assoc();

//Dit geeft dus maar één rij terug.
    $db->close();

    return $result;
}