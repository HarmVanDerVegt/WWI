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

function getStockGroupByStockItemID($ID){

    global $tableStockGroups;


    return getRowByForeignID($ID, $tableStockGroups, "StockITems", "StockItemID", "StockItemID");

}
?>
