<?php

include_once ROOT_PATH . "/controllers/databaseController.php";


$tableReviews = "reviews";

function getAllReviews() {

    global $tableReviews;

    return getAllRows($tableReviews);
}

function getUserSpecificReviewByStockItemID($CustomerID, $StockItemID) {

    $db = createDB();
    $sql = ""
            . "SELECT Waarde "
            . "FROM reviews "
            . "WHERE personID = " . $CustomerID . " "
            . "AND stockitemID = " . $StockItemID . " ";

    $result = $db->query($sql);

    $result = $result->fetch_assoc();

    $db->close();

    return $result["Waarde"];
}

function createFilledStar($ID) {
    $html = "
                <form method=\"post\">
            <input type='hidden' name=\"ster\" value=\"$ID\" />
            <button name='review' value='click' style=\"float: left; padding-left: 0; background:transparent; border-style:hidden\">
            <i class=\"fas fa-star\"></i>
            </button>
            </form>
            ";
    return $html;
}

function createUnfilledStar($ID) {
    $html = "
                <form method=\"post\">
            <input type='hidden' name=\"ster\" value=\"$ID\" />
            <button name='review' value='click' style=\"float: left; padding-left: 0; background:transparent; border-style:hidden\">
            <i class=\"far fa-star\"></i>
            </button>
            </form>
            ";
    return $html;
}

function getCurrentReviewValue($reviewwaarde) {
    if (is_int($reviewwaarde) == false) {
        return null;
    }
    if ($reviewwaarde <= 0 || $reviewwaarde > 5) {
        return null;
    }

    $ongevuld = 5 - $reviewwaarde;
    $gevuld = 5 - $ongevuld;

    $html = "";

    for ($i = 1; $i <= $gevuld; $i++) {
        $html .= createFilledStar($i);
    }

    for ($i = ($gevuld + 1); $i <= ($ongevuld + $gevuld); $i++) {
        $html .= createUnfilledStar($i);
    }


    return $html;
}

function insertReviewValue($userid, $stockitemID, $reviewvalue) {

    $db = createDB();

    if ($reviewvalue >= 1 && $reviewvalue <= 5) {

        $sql = "INSERT INTO reviews (PersonID, StockItemID, Waarde)
            VALUES ( " . $userid . ", " . $stockitemID . ", " . $reviewvalue . " )
            ON DUPLICATE KEY UPDATE Waarde=$reviewvalue";

        $db->query($sql);

        $db->close();
        
    } else {
        return '<META HTTP-EQUIV="refresh" content="=0;URL=../error.php>';
    }
}

function getAverageReviewValue($stockitemID) {

    $db = createDB();
    $sql = ""
            . "SELECT AVG(Waarde) average "
            . "FROM reviews "
            . "WHERE StockItemID = '" . $stockitemID . "' ";

    $result = $db->query($sql);

    $result = $result->fetch_assoc();

    $db->close();

    return $result["average"];
}

function getReviewCountByStockItemID($StockItem) {
    $db = createDB();

    $sql = "SELECT COUNT(*) count
            FROM reviews
            WHERE StockItemID=" . $StockItem["StockItemID"];

    $result = $db->query($sql);

    $result = $result->fetch_assoc();

    $db->close();

    return $result["count"];
}

function getreviewbystockid($id) {
    return getRowByIntID("StockItemID", "reviews", $id);
}

function getProductSpecificReviewByStockItemID($StockItemID) {

    $db = createDB();
    $sql = ""
        . "SELECT * "
        . "FROM reviews "
        . "WHERE stockitemID = " . $StockItemID . " ";

    $result = $db->query($sql);

    $array = [];
    while ($row = $result->fetch_assoc()) {
        $array[array_values($row)[0]] = $row;
    }

    $db->close();

    return $result;
}

function deletereview($personid, $stockitemid, $waarde) {
    $db = createDB();
    $sql = " "
            . "delete from reviews where PersonID = " . $personid
            . " and StockItemID = " . $stockitemid
            . " and Waarde = " . $waarde
            . " ";

    $db->query($sql);

    $db->close();

    return null;
}
