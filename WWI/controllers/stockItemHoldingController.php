<?php
include_once ROOT_PATH . "/config.php";
include_once ROOT_PATH . "/controllers/databaseController.php";

$tableStockItemHoldings = "stockItemHoldings";

function getStockItemHoldingByID($ID){

    global $tableStockItemHoldings;

    return getRowByIntID("stockItemID", $tableStockItemHoldings, $ID);
}