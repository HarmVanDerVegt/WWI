

<?php
include_once "../controllers/userController.php";

session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$returnar = getUser($username, $password);

echo "Ingelogde user is: " . $returnar["FullName"] . "<br>";
echo "Email van user is: " . $returnar["LogonName"];
$_SESSION['IsEmployee']= $returnar["IsEmployee"];
$_SESSION['IsSystemUser']= $returnar["IsSystemUser"];
$_SESSION['PreferredName']= $returnar["PreferredName"];
$_SESSION['FullName']= $returnar["FullName"];



?>
