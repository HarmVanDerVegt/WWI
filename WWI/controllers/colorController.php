<?php
include_once ROOT_PATH . "/controllers/databaseController.php";

$tablecolors = "colors";

function getAllColors(){
    
    global $tablecolors;
    
    return getAllRows($tablecolors);
}

function getColorByID($ID){
    global $tablecolors;
    
    return getRowByIntID("ColorID", $tablecolors, $ID);
}
