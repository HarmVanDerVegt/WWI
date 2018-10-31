<?php
include_once ROOT_PATH . "/config.php";
include_once ROOT_PATH . "/controllers/databaseController.php";

$tableSuppliers = "suppliers";

function getAllSuppliers()
{
    global $tableSuppliers;

    return getAllRows($tableSuppliers);
}

function getSupplierByID($ID)
{
    global $tableSuppliers;

    return getRowByIntID("SupplierID", $tableSuppliers, $ID);
}