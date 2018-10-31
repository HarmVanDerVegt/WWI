<?php
include_once ROOT_PATH . "/config.php";
include_once ROOT_PATH . "/controllers/databaseController";

$tableStockGroups = "stockGroups";

function getAllStockGroups(){
    
    global $tableStockGroups;
    
    return getAllRows($tableStockGroups);
}

function getStockGroupByID($ID){
    global $tableStockGroups;
    
    return getRowByIntID("stockGroupID", $tableStockGroups, $ID);
}

