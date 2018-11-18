<?php
include_once "databaseController.php";


function createUser($firstName, $lastname, $email, $password){
     $db = createDB();

     $fullName = $firstName . " " . $lastname;
     $searchName = $firstName . " " . $fullName;
     $hashedPassword = hash('sha256', $password);

     $sql = "INSERT INTO people(FullName, PreferredName, SearchName, IsPermittedToLogon, LogonName, HashedPassword, IsSystemUser, EmailAddress)
             VALUES ($fullName, $firstName, $searchName, true, $email, $hashedPassword, true, $email) ";

    if ($db->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    $db->close();
}

function getUser($logonName, $password){
    $db = createDB();

    $hashedPassword = hash('sha256', $password);

    $sql = "SELECT *
            FROM people
            WHERE logonName=\"$logonName\"
            AND HashedPassword=\"$hashedPassword\"";

    //echo $sql;

    $result = $db->query($sql);

    //echo "<br>";
    //echo $result;

    $result = $result->fetch_assoc();
    $db->close();
    return $result;

}