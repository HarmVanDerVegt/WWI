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
    $array = [];
    $sql = ""
            . "SELECT * "
            . "FROM review "
            . "WHERE customerID = '" . $CustomerID . "' "
            . "AND stockitemID = '" . $StockItemID . "' ";

    $result = $db->query($sql);

//    while ($row = $result->fetch_assoc()) {
//        $array[array_values($row)[0]] = $row;
//    }

    $db->close();

    return $result;
}

function createFilledStar($ID) {
    $html = "
                <form method=\"post\">
            <input type='hidden' name=\"ster\" value=\"$ID\" />
            <button style=\"float: left; padding-left: 0; background:transparent; border-style:hidden\">
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
            <button style=\"float: left; padding-left: 0; background:transparent; border-style:hidden\">
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

    for($i = 1; $i <= $gevuld; $i++) {
        $html .= createFilledStar($i);
    }
    
    for($i = ($gevuld + 1); $i <= ($ongevuld + $gevuld); $i++) {
        $html .= createUnfilledStar($i);
    }
    
    return $html;
}