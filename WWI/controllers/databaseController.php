<?php

function createDB()
{
    // Create connection
    $dbcon = mysqli_connect('localhost', 'root', 'Q9sZbU9Tp9uvugE', 'wideworldimporters');

    // Check connection
    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }

    return $dbcon;
}

//Geeft een rij uit de database terug als array.
//Gebruik: $result[attribute]
//Voorbeeld:    $item =  getRowByIntID("StockItemID", 'stockItems", 6);
//              $item["StockItemName"];
function getRowByIntID($ID, $table, $value)
{
    //Initieert de database.
    $db = createDB();

    $sql = "SELECT *
            FROM $table
            WHERE $ID = $value";

    //Voert de statement uit.
    $result = $db->query($sql);

    //Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
    //Dit geeft dus maar één rij terug.
    $result = $result->fetch_assoc();
    $db->close();

    return $result;
}

function getAllRows($table)
{
    $db = createDB();

    $sql = "SELECT *
            FROM $table";

    $result = $db->query($sql);

    //Dit gaat een array van arrays teruggeven
    $array = [];

    //Voor elk result stoppen we het in de array
    //MEt als index de value van de eerste column, wat een primary key is.
    while ($row = $result->fetch_assoc()) {
        $array[array_values($row)[0]] = $row;
    }

    return $array;
}

function getRowByForeignID($value, $table1, $table2, $joinID, $joinID2)
{

    $db = createDB();

    $sql = "SELECT *
            FROM $table1 AS t1
            JOIN $table2 AS t2
            ON t1.$joinID = t2.$joinID2
            WHERE t1.$joinID = $value";

    $result = $db->query($sql);

    $array = [];

    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $array[$i] = $row;
        $i++;
    }
    return $array;
}

function getHighestAttributeByIntID($ID, $table)
{
    $db = createDB();

    $sql = "SELECT MAX($ID) hoogste
            FROM $table";

    $result = $db->query($sql);

    $result = $result->fetch_assoc()["hoogste"];

    $db->close();

    return $result;
}

function getLowestAttributeByIntID($ID, $table)
{
    $db = createDB();
    $sql = "SELECT MIN($ID) laagste
            FROM $table";

    $result = $db->query($sql);

    $result = $result->fetch_assoc()["laagste"];

    $db->close();

    return $result;
}

function getRowByTwoForeignIDs($value, $table1, $table2, $table3, $joinID, $joinID2)
{

    $db = createDB();

    $sql = "SELECT *
            FROM $table1 AS t1
            JOIN $table2 AS t2
            ON t1.$joinID = t2.$joinID
            JOIN $table3 AS t3
            ON t2.$joinID2 = t3.$joinID2
            WHERE t1.$joinID = $value";

    $result = $db->query($sql);
    $returnValue = $result->fetch_assoc();

    $db->close();

    return $returnValue;
}


//Controller voor Bestelstatus
function getQuantityByPurchaseOrderID($value, $table1, $table2, $joinID, $joinID2)
{

    $db = createDB();

    $sql = "SELECT *, COUNT(*) as Quantity
            FROM $table1 AS t1
            JOIN $table2 AS t2
            ON t1.$joinID = t2.$joinID2
            WHERE t1.$joinID = $value
            GROUP BY stockitemID";

    $result = $db->query($sql);

    $array = [];

    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $array[$i] = $row;
        $i++;
    }

    $db->close();

    return $array;
}