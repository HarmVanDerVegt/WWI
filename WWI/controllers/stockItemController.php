<?php

include_once ROOT_PATH . "/controllers/databaseController.php";

$tableStockItems = "stockItems";

function getAllStockItems() {
    global $tableStockItems;

    return getAllRows($tableStockItems);
}

function getStockItemByID($ID) {
    global $tableStockItems;

    return getRowByIntID("stockItemID", $tableStockItems, $ID);
}

function getStockItemBySupplierID($ID) {

    global $tableStockItems;


    return getRowByForeignID($ID, $tableStockItems, "Suppliers", "SupplierID", "SupplierID");
}

function getStockItemBySpecialDealID($ID) {

    global $tableStockItems;


    return getRowByForeignID($ID, $tableStockItems, "SpecialDeals", "StockItemID", "StockItemID");
}

function getStockItemsBySearchDetails($search) {
    $db = createDB();
    $search = mysqli_escape_string($db, $search);
    $array = array();
    $sql = "SELECT *
            FROM stockitems
            WHERE SearchDetails like \"%$search%\" ";

    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        $array[array_values($row)[0]] = $row;
    }

    $db->close();

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

    $db->close();

    return $returnTags;
}

function getStockItemsByStockGroupID($category_id) {

    if(empty($category_id)){
        return [];
    }

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

function getSearchedItems($details, $tags, $categoryID){

    //Haal per zoekterm de StockItemIDs op die er bij horen.
    //Je krijgt nu nog IDs die niet in het eindresultaat horen.
    $details = getStockItemsBySearchDetails($details);
    $tags = getStockItemsByTags($tags);
    if( empty($categoryID)){
        $categoryID = [];
    }
    else {
        $categoryID = $categoryID[0];
    }


    $detailsIDs = array_column($details, "StockItemID");
    $tagsIDs = array_column($tags, "StockItemID");
    $categoryIDs = getStockItemsByStockGroupID($categoryID);
    $categoryIDs = array_column($categoryIDs, "StockItemID");

    //Hier maken we de lijst van alle IDs.
    $allIDs = array_union($detailsIDs, $tagsIDs);
    $allIDs = array_union($allIDs, $categoryIDs);

    //Als één of meerdere van de zoektermen leeg is wordt hij gevuld met alle IDs van de andere zoektermen.
    //Dit doen we omdat je geen doorsnede kan doen op een lege array, dat geeft natuurlijk niks terug.
    if (empty($detailsIDs)){
        $detailsIDs = $allIDs;
    }

    if (empty($tagsIDs)){
        $tagsIDs = $allIDs;
    }
    if (empty($categoryIDs)){
        $categoryIDs = $allIDs;
    }

    //Hier vragen wij de doorsnede van alle IDs van de zoektermen.
    //Je krijgt dan alleen de Ids van de StockItems waarvoor alle zoektermen gelden.
    $query = array_intersect($detailsIDs, $tagsIDs, $categoryIDs);

    $searchedItems = [];

    //Voor elke ID na de doorsnede halen we het product op.
    foreach ($query as $item){
        $searchedItems[] = getStockItemByID($item);
    }

    //We returnen een array van alle opgezochte StockItems als array.
    return $searchedItems;

}

//Voegt twee arrays samen met overschrijving van dubbele waardes.
function array_union($array1, $array2){
    //$array1 =                                     [1, 2, 3,    6, 7   ];
    //$array2 =                                     [   2, 3, 5,       8];
    $union = array_merge(
                array_intersect($array1, $array2),//[   2, 3            ];
                array_diff($array1, $array2),     //[1,          6, 7   ];
                array_diff($array2, $array1)      //[         5,       8];
        );                                        //[1, 2, 3, 5, 6, 7, 8];

    return $union;
}

function getStockItemsByTags($tags){

    if (empty($tags)){
        return [];
    }

    $db = createDB();

    $sql = "SELECT *
            FROM StockItems
            WHERE (";

    foreach ($tags as $tag){
        $strippedTag = trim($tag, '"');
        $sql = $sql . " Tags LIKE \"%$strippedTag%\"";

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

