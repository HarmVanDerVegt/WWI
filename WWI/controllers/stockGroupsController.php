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


     return getRowByTwoForeignIDs($ID, "StockItems", "StockItemStockGroups", "StockGroups", "StockItemID", "StockGroupID");

}

function getImageLinkFromStockGroupID($ID){
    $category = getStockGroupByID($ID);

    $categoryName = $category["StockGroupName"];

    $categoryName = str_replace(" ", "", $categoryName);
    $categoryName = str_replace("-", "", $categoryName);

    $categoryName = strtolower($categoryName);

    $returnstring = "../media/" . $categoryName . ".jpg";
    return $returnstring;
}

function getImageLinkFromStockGroupID2($ID){
    $category = getStockGroupByID($ID);

    $categoryName = $category["StockGroupName"];

    $categoryName = str_replace(" ", "", $categoryName);
    $categoryName = str_replace("-", "", $categoryName);

    $categoryName = strtolower($categoryName);

    $returnstring = "media/" . $categoryName . ".jpg";
    return $returnstring;
}

function getStockGroupByName($name){
    $name = "\"" . $name . "\"";

    $db = createDB();

    $sql = "SELECT *
            FROM StockGroups
            WHERE StockGroupName=$name";

    print $sql;

    $result = $db->query($sql);

    $result = $result->fetch_assoc();

    return $result;
}

function getStockGroupLink($StockGroup){
    $name = $StockGroup["StockGroupName"];
    $link = "category/product_lijst.php?category=$name";

    return $link;
}
?>
