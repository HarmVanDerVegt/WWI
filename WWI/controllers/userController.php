<?php
include_once "databaseController.php";




function getUser($logonName, $password){
    $db = createDB();


    $sql = "SELECT *
            FROM people
            WHERE logonName=\"$logonName\"
            ";




    $result = $db->query($sql);

    $result = $result->fetch_assoc();


    $db->close();
    $resultww = password_verify($password,$result['HashedPassword']);
    if($resultww == TRUE){

        $result['Succes']= $resultww;
        return $result;}
        else{
            $result['Succes']= FALSE;


    }
}


function getCustomerByID($ID){


    return getRowByIntID('PrimaryContactPersonID','Customers',  $ID);
}

function getCityByID($ID){


    return getRowByIntID('CityID','cities',  $ID);

}
