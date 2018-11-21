<?php
include_once "databaseController.php";




function getUser($logonName, $password){
    $db = createDB();


    $sql = "SELECT *
            FROM people
            WHERE logonName=\"$logonName\"
            ";

    echo $sql;



    $result = $db->query($sql);

    echo "<br>";

    $result = $result->fetch_assoc();
    print_r ($result);


    $resultww = password_verify($password,$result['HashedPassword']);
    if($resultww == TRUE){
    return $result;}
    else{
        echo "ww is verkeerd";
    }
    $db->close();
}