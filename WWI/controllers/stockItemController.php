<?php

include_once ROOT_PATH . "/controllers/databaseController.php";

$tableStockItems = "stockItems";

//Geeft alle stockItems terug als array in een array, met als identifiers de stockItemIDs.
function getAllStockItems() {
    global $tableStockItems;

    return getAllRows($tableStockItems);
}

//Geeft een stockItem als array terug, met als keys de namen van de attributen en de values als values.
function getStockItemByID($ID) {
    global $tableStockItems;

    return getRowByIntID("stockItemID", $tableStockItems, $ID);
}

//Geeft een stockItem als array terug, met als keys de namen van de attributen en de values als values.
function getStockItemBySupplierID($ID) {

    global $tableStockItems;


    return getRowByForeignID($ID, $tableStockItems, "Suppliers", "SupplierID", "SupplierID");
}

//Geeft een stockItem als array terug, met als keys de namen van de attributen en de values als values.
function getStockItemBySpecialDealID($ID) {

    global $tableStockItems;


    return getRowByForeignID($ID, $tableStockItems, "SpecialDeals", "StockItemID", "StockItemID");
}

//Geeft een stockItem als array terug, met als keys StockItemID en StockItemName.
function getStockItemsBySearchDetails($search) {
    $db = createDB();
    $array = array();
    $sql = "SELECT StockItemID, StockItemName
            FROM stockitems
            WHERE SearchDetails like \"%$search%\" ";

    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        $array[array_values($row)[0]] = $row;
    }

    return $array;
}

function getSearchTags(){
    $db = createDB();

    $sql = "SELECT DISTINCT(Tags)
            FROM StockItems";

    $result = $db->query($sql);


    while ($tags = $result->fetch_assoc()){
        $array[] = $tags["Tags"];
    }

    $filteredTags = [];

    foreach ($array as $tag){

        $tag = trim($tag, "[]");

        $tag = explode(",", $tag);

        $filteredTags = array_merge($filteredTags, $tag);
    }


    $unigueTags = array_unique($filteredTags);

    $returnTags = [];

    foreach ($unigueTags as $unigueTag){
        if (!empty($unigueTag)){
            $returnTags[] = $unigueTag;
        }
    }

    return $returnTags;
}

function getStockItemsByStockGroupID($category_id) {
    $db = createDB();
    $array = [];
    $sql = ""
            . "SELECT * "
            . "FROM stockitems SI "
            . "JOIN stockitemstockgroups SI_SG "
            . "ON SI.StockItemID = SI_SG.StockItemID "
            . "JOIN stockgroups SG "
            . "ON SI_SG.StockGroupID=SG.StockGroupID "
            . "WHERE SG.StockGroupID='" . $category_id . "' ";

    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        $array[array_values($row)[0]] = $row;
    }

    $db->close();

    return $array;
}

function getStockGroupIDsFromStockItemID($ID) {
    $db = createDB();

    $sql = ""
            . "SELECT sisg.StockGroupID "
            . "FROM stockitemstockgroups sisg "
            . "WHERE stockitemID ='" . $ID . "' ";

    $result = $db->query($sql);

    $array = [];
    
    while ($row = $result->fetch_assoc()) {
        $array[] = $row["StockGroupID"];
    }
    
    $db->close();

    return $array;
}

function getSearchedItems(){

}

function getStockItemsByTags($tags){
    $db = createDB();

    $sql = "SELECT StockItemName
            FROM StockItems
            WHERE (";

    foreach ($tags as $tag){
        $sql = $sql . " Tags LIKE \"%$tag%\"";

        //If this is not the latest tag:
        if ($tags[count($tags) - 1] != $tag){
            $sql = $sql . " OR";
        }
    }

    $sql = $sql . ")";

    $result = $db->query($sql);

    $array = [];

    while ($row = $result->fetch_assoc()){
        $array[] = $row;
    }

    $db->close();

    return $array;
}