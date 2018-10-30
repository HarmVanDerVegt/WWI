<?php

function createDB()
{
    // Create connection
    $dbcon = mysqli_connect('localhost', 'root', '', 'wideworldimporters');

    // Check connection
    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }
    echo "succes";

    return $dbcon;

    //define(DB, $dbcon);
}

function getRowByIntID($ID, $table, $value){
    $db = createDB();

    $value = (int)$value;

    $sql = "SELECT *
            FROM $table
            WHERE $ID = $value";

    $result = $db->query($sql);

    return $result->fetch_assoc();
}