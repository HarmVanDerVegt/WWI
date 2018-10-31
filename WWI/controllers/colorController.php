<?php

include_once ROOT_PATH . "/config.php";
include_once ROOT_PATH . "/controllers/databaseController.php";

$tablecolors = "colors";

function getAllColors(){
    
    global $tablecolors;
    
    return getAllRows($tablecolors);
}

function getColorsByID($ID){
    global $tablecolors;
    
    return getRowByIntID("ColorID", $tablecolors, $ID);
}
