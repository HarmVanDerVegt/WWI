<?php
include_once  ROOT_PATH . "/controllers/databaseController.php";

$tableStockItems = "stockItems";

//Geeft alle stockItems terug als array in een array, met als identifiers de stockItemIDs.
function getAllStockItems()
{
    global $tableStockItems;

    return getAllRows($tableStockItems);
}

//Geeft een stockItem als array terug, met als keys de namen van de attributen en de values als values.
function getStockItemByID($ID){
    global $tableStockItems;

    return getRowByIntID("stockItemID", $tableStockItems, $ID);
}

//Geeft een stockItem als array terug, met als keys de namen van de attributen en de values als values.
function getStockItemBySupplierID($ID)
{

    global $tableStockItems;


    return getRowByForeignID($ID, $tableStockItems, "Suppliers", "SupplierID", "SupplierID");
}

//Geeft een stockItem als array terug, met als keys de namen van de attributen en de values als values.
function getStockItemBySpecialDealID($ID)
{
    
    global $tableStockItems;
    
    
    return getRowByForeignID($ID, $tableStockItems, "SpecialDeals", "StockItemID", "StockItemID");
}
//Geeft een stockItem als array terug, met als keys StockItemID en StockItemName.
function getStockItemsBySearchDetails($search){
    $db = createDB();
    $array = array ();
    $sql = "SELECT StockItemID, StockItemName
            FROM stockitems
            WHERE SearchDetails like \"%$search%\" ";

    $result =  $db->query($sql);

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

    $array = [];

    while ($tags = $result->fetch_assoc()){
        array_push($array, $tags["Tags"]);
    }


    print_r($array);
    echo "<br><br<br> XXXXX <br><br><br>";
    $filteredTags = [];

    foreach ($array as $tag){
        print_r($tags);
        //print "<br>";
        //foreach ($tags as $tag){
        //    print_r($tag);
        //    print "<br>";
        //    array_push($filteredTags, $tag["Tags"]);
        //}
    }

    print_r($filteredTags);

    $unigueTags = array_unique($filteredTags);

    print_r($unigueTags);

}
