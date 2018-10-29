<?php
$servername = "localhost";
$username = "root";
$dbname = "wideworldimporters";

// Create connection
$dbcon = new mysqli($servername, $username);

// Check connection
if ($dbcon->connect_error) {
    die("Connection failed: " . $dbcon->connect_error);
}
echo "Connected successfully";
?>
