<?php

function maak_connectie() {
    // Connect met sql server
    return mysqli_connect('localhost', 'root', '', 'wideworldimporters');
}

// geeft de gemidelde tempratuur van alle sensors
// uit: tempratuur
function gemidelde_tempratuur(){
    // geef commando
    $sql_code = "SELECT Temperature FROM coldroomtemperatures";
    
    // roep database aan
    $db = maak_connectie();
    $resultaat = mysqli_query($db, $sql_code);
    $db = NULL;
    
    // bereken het gemidelde
    $som=0;
    $i=0;
    while($rij = mysqli_fetch_assoc($resultaat)){
        $som += $rij["Temperature"];
        $i++;
    }
    return ($som/$i);
}


// geeft de meest recente tempratuur van een speciefieke sensor
// in: $id als integer
// uit: tempratuur
function tempratuur($id) {
    // filter $id van verkeerde input
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    // geef commando
    $sql_code = "SELECT Temperature FROM coldroomtemperatures
                 WHERE ColdRoomSensorNumber=".$id."
                 LIMIT 1";

    // roep database aan
    $db = maak_connectie();
    $resultaat = mysqli_query($db, $sql_code);
    $db = NULL;
    
    // geef huidige tempratuur
    return mysqli_fetch_assoc($resultaat)["Temperature"];
}

// checkt of een stockitem gekoeld wordt
// in: $stockitemID als int
// uit: True of False 
function isGekoeld($stockitemID){
    // filter $id van verkeerde input
    $stockitemID = filter_var($stockitemID, FILTER_SANITIZE_NUMBER_INT);

    // geef commando
    $sql_code = "SELECT * FROM stockitems
                 WHERE IsChillerStock=1
                 AND stockitemID=".$stockitemID;

    // roep database aan
    $db = maak_connectie();
    $resultaat = mysqli_query($db, $sql_code);
    $db = NULL;
    
    // check of opgegeven stockitem gekoeld wordt
    if(mysqli_num_rows($resultaat) > 0){
        return True;
    }
    else{
        return False;
    }
}
