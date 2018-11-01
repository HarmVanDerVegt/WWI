<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
include_once ROOT_PATH . "/config.php";
include_once  ROOT_PATH . "/controllers/databaseController.php";

include(ROOT_PATH . "/includes/header.php");

?>
<?php $Search = (filter_input(INPUT_GET, "Zoeken", FILTER_SANITIZE_STRING));

if (filter_input(INPUT_GET, "Zoeken", FILTER_SANITIZE_STRING) <> ""){
    var_dump(getSEARCHInfo($Search));
}

function getSEARCHInfo($search){
    $db = createDB();

    $sql = "SELECT SearchDetails
            FROM stockitems
            WHRERE SearchDetails like\"%$search%\" " ;

    $result = $db->query($sql);


    return $result;
}

//foreach ($Resultar as $Result){
//    echo $Result ."/n";
//}
?>
<?php  include(ROOT_PATH . "/includes/footer.php"); ?>