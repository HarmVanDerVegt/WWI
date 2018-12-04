<?php

include_once ROOT_PATH . "/controllers/databaseController.php";

//////////////////////////////////////////////////////////
//                                                      //
//                  NIET FUNCTIONEEL                    //
//              WEL NODIG, NOG NIET RELEVANT            //
//                  NIET VERWIJDEREN                    //
//                                                      //
//////////////////////////////////////////////////////////

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
    $sql = "INSERT INTO reviews (PersonID, StockItemID, Waarde)
            VALUES ( " . $userid . ", " . $stockitemID . ", " . $reviewvalue . " )
            ON DUPLICATE KEY UPDATE Waarde=$reviewvalue";

    $db->query($sql);

    $db->close();
}

function getAverageReviewValue($stockitemID) {

    $db = createDB();
    $array = [];
    $sql = ""
            . "SELECT AVG(Waarde) average "
            . "FROM reviews "
            . "WHERE StockItemID = '" . $stockitemID . "' ";

    $result = $db->query($sql);

    $result = $result->fetch_assoc();

    $db->close();

    return $result["average"];
}
