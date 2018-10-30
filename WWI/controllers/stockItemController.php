<?php
include_once ROOT_PATH . "/config.php";
include_once  ROOT_PATH . "/controllers/databaseController.php";

$table = "stockItems";

function getAllStockItems()
{
    global $table ;

    $db = createDB();

    $sql = "SELECT stockItemID
            FROM {$table};";

    $result = $db->query($sql);

    $array = [];

    while ($row = $result->fetch_assoc()) {
        $array[$row["stockItemID"]] = $row;
    }

    return $array;
}

function getStockItemByID($ID){
    global $table;

    return getRowByIntID("stockItemID", $table, $ID);
}