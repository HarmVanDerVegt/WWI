<?php
include_once  ROOT_PATH . "/controllers/databaseController.php";

$tableStockItems = "stockItems";

function getAllStockItems()
{
    global $tableStockItems;

    return getAllRows($tableStockItems);
}

function getStockItemByID($ID){
    global $tableStockItems;

    return getRowByIntID("stockItemID", $tableStockItems, $ID);
}

function getStockItemBySupplierID($ID)
{

    global $tableStockItems;


    return getRowByForeignID($ID, $tableStockItems, "Suppliers", "SupplierID", "SupplierID");
}

function getStockItemBySpecialDealID($ID)
{
    
    global $tableStockItems;
    
    
    return getRowByForeignID($ID, $tableStockItems, "SpecialDeals", "StockItemID", "StockItemID");
}

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
