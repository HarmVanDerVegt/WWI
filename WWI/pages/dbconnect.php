<?php

// Create connection
$dbcon = mysqli_connect('localhost','root','','wideworldimporters');


// Check connection
if ($dbcon->connect_error) {
    die("Connection failed: " . $dbcon->connect_error);
}

?>
