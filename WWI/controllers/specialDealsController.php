<?php
include_once ROOT_PATH . "/config.php";
include_once ROOT_PATH . "/controllers/databaseController.php";

$tableSpecialDeals = "specialDeals";

function getAllSpecialDeals(){
    
    global $tableSpecialDeals;
    
    return getAllRows($tableSpecialDeals);
}

function getSpecialDealByID($ID){
    global $tableSpecialDeals;
    
    return getRowByIntID("specialDealID", $tableSpecialDeals, $ID);
}

function getSpecialDealByStockItemID($ID){
    
    global $tableSpecialDeals;
    
    return getRowByForeignID($ID, $tableSpecialDeals, "stockitems", "StockitemID", "StockitemID");
}
