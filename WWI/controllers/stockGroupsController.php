<?php
include_once ROOT_PATH . "/controllers/databaseController.php";

$tableStockGroups = "stockGroups";

function getAllStockGroups(){
    
    global $tableStockGroups;
    
    return getAllRows($tableStockGroups);
}

function getStockGroupByID($ID){
    global $tableStockGroups;
    
    return getRowByIntID("stockGroupID", $tableStockGroups, $ID);
}

function getStockGroupIDByStockItemID($ID){


     return getRowByForeignID($ID, "StockItemStockGroups", "StockItems", "StockItemID", "StockItemID");

}
?>
