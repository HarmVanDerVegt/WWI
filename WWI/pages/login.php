<?php
include_once "../controllers/userController.php";

$username = $_POST["username"];
$password = $_POST["password"];

$user = getUser($username, $password);

echo "Ingelogde user is: " . $user["FullName"] . "<br>";
echo "Email van user is: " . $user["EmailAddress"];