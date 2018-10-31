<?php
include_once ROOT_PATH . "/config.php";
include_once  ROOT_PATH . "/controllers/databaseController.php";

$tableStockItems = "stockItems";

function getAllStockItems()
{
    global $tableStockItems;

    return getAllRows($tableStockItems);
}

function getStockItemByID($ID){
    global $tableStockItems;

    return getRowByIntID("stockItemID", $tableStockItems, $ID);
}

function getStockItemBySupplierID($ID)
{

    global $tableStockItems;


    return getRowByForeignID($ID, $tableStockItems, "Suppliers", "SupplierID", "SupplierID");
}


