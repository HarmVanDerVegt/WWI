<?php
include_once ROOT_PATH . "/config.php";

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

function getStockItemByID($SELECT, $FROM, $WHERE){

    $db = createDB();

    $sql = "SELECT {$SELECT}
            FROM {$FROM}
            WHERE {$WHERE}";

    $result = $db->query($sql);

    return $result;
}