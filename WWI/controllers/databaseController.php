<?php

function createDB()
{
    // Create connection
    $dbcon = mysqli_connect('localhost', 'root', '', 'wideworldimporters');

    // Check connection
    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }
    //echo "succes";

    return $dbcon;
}

//Geeft een rij uit de database terug als array.
//Gebruik: $result[attribute]
function getRowByIntID($ID, $table, $value){
    //Initieert de database.
    $db = createDB();

    //Geeft een error als de value geen int is.
    $value = (int)$value;

    //Prepared de SQL statement.
    $sql = "SELECT *
            FROM $table
            WHERE $ID = $value";

    //Voert de statement uit.
    $result = $db->query($sql);

    //Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
    //Dit geeft dus maar één rij terug.
    return $result->fetch_assoc();
}

function getAllRows($table){
    $db = createDB();

    $sql = "SELECT *
            FROM $table";

    $result = $db->query($sql);

    $array = [];

    while ($row = $result->fetch_assoc()){
        $array[array_values($row)[0]] = $row;
    }

    return $array;
}

function getRowByForeignID($ID, $table1, $table2, $value, $joinID, $joinID2){

    $db = createDB();

    $sql = "SELECT *
            FROM $table1 AS t1
            JOIN $table2 AS t2
            ON t1.$joinID = t2.$joinID2
            WHERE t1.$joinID = $value";

    $result = $db->query($sql);

    return $result->fetch_assoc();

}