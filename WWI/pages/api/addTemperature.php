<?php
/**
 * Created by PhpStorm.
 * User: harmv
 * Date: 06/12/2018
 * Time: 09:47
 */

include_once ROOT_PATH . "/controllers/databaseController.php";

function getMaxTemperatureID(){
    $db = createDB();

    $sql = "SELECT MAX(ColdRoomTemperatureID) max
            FROM coldroomstemperatures";

    $result = $db->query($sql);

    $result = $result->fetch_assoc();

    $db->close();

    return $result["max"];
}

$verificationToken = "6fee2407ebee034115f5fdd2cb5a5d8b";

$token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_STRING);
$sensor = filter_input(INPUT_GET, "sensor", FILTER_SANITIZE_NUMBER_INT);
$temperature = filter_input(INPUT_GET, "temperature", FILTER_SANITIZE_NUMBER_FLOAT);

if ($verificationToken != $token){
    return "Niet geldig!";
}

$ID = getMaxTemperatureID() + 1;

$today = date("Y-m-d H:i:s");
$validTo = date("9999-12-31 23:59:59");

$db = createDB();

$sql = "INSERT INTO coldroomtemperatures
        VALUES($ID, $sensor, $today, $temperature, $today, $validTo)";

$db->query($sql);
