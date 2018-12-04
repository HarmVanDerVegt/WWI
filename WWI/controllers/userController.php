<?php
include_once "databaseController.php";




function getUser($logonName, $password){
//start database connectie
    $db = createDB();

// sql voor controleren van gebuikersnaam
    $sql = "SELECT *
            FROM people
            WHERE logonName=\"$logonName\"
            ";




    $result = $db->query($sql);
// waarde van array to string
    $result = $result->fetch_assoc();

// controlleren van het wachtwoord en sluiten database connectie
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

//verkijg een cumtomer bij customerID
    return getRowByIntID('PrimaryContactPersonID','Customers',  $ID);
}

function getCityByID($ID){

//verkijg een cumtomer bij cityID
    return getRowByIntID('CityID','cities',  $ID);

}
