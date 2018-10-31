<?php
include_once ROOT_PATH . "/config.php";
include_once  ROOT_PATH . "/controllers/databaseController.php";

$table = "stockItems";

function getAllStockItems()
{
    global $table ;

    return getAllRows($table);
}

function getStockItemByID($ID){
    global $table;

    return getRowByIntID("stockItemID", $table, $ID);
}

function getStockItemBySupplierID($ID)
{

    global $table;

    $db = createDB();

    $sql = "SELECT *
            FROM $table AS si
            JOIN Suppliers AS s
            ON s.SupplierID = si.SupplierID
            WHERE si.SupplierID = $ID";

    $result = $db->query($sql);

    $array = [];

    while ($row = $result->fetch_assoc()) {
        $array[array_values($row)[0]] = $row;


    }
    return $array;
}


