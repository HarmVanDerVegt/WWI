

<?php
include_once "../controllers/userController.php";



$username = $_POST["username"];
$password = $_POST["password"];

$returnar = getUser($username, $password);

echo "Ingelogde user is: " . $returnar["FullName"] . "<br>";
echo "Email van user is: " . $returnar["LogonName"];
$returnar['IsEmployee'] = $_SESSION['IsEmployee'];
$returnar['IsSystemUser'] = $_SESSION['IsSystemUser'];
$returnar['PreferredName'] = $_SESSION['PreferredName'];
$returnar['FullName'] = $_SESSION['FullName'];


?>
