<?php
include_once ROOT_PATH . "/config.php";
include_once  ROOT_PATH . "/controllers/databaseController.php";

$table = "stockItems";

function getAllStockItems()
{
    global $table ;

    return getAllRows($table);
}

function getStockItemByID($ID){
    global $table;

    return getRowByIntID("stockItemID", $table, $ID);
}

function getStockItemBySupplierID($ID)
{

    global $table;


    return getRowByForeignID($ID, $table, "Suppliers", "SupplierID", "SupplierID");
}


