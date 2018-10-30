<?php

define("ROOT_PATH", __DIR__);

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
