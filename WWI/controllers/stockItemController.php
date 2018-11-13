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

function getSearchTags() {
    $db = createDB();

    $sql = "SELECT DISTINCT(Tags)
            FROM StockItems";

    $result = $db->query($sql);

    //$array = [];

    while ($tags = $result->fetch_assoc()) {
        //array_push($array, $tags["Tags"]);
        $array[] = $tags["Tags"];
    }


    print_r($array);
    echo "<br><br<br> XXXXX <br><br><br>";
    $filteredTags = []; //array_map('current', $array);

    $i = 0;
    foreach ($array as $tag) {
        //print_r($tags);
        //print $i;
        //print "<br>";
        //foreach ($tags as $tag){
        //    print_r($tag);
        //    print "<br>";
        //    array_push($filteredTags, $tag["Tags"]);
        //}
        $tag = explode(",", $tag);
        $i++;
        $filteredTags = array_merge($filteredTags, $tag);
    }



    print_r($filteredTags);

    //$unigueTags = array_unique($filteredTags);
    //print_r($unigueTags);
}

function getStockItemsByStockGroupID($category_id) {
    $db = createDB();
    $array = [];
    $sql = ""
            . "SELECT SI.stockitemID "
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
