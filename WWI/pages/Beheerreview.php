<?php
if (!defined('ROOT_PATH')) {
    include_once("../config.php");
}

include_once ROOT_PATH . "/controllers/databaseController.php";
include_once ROOT_PATH . "/controllers/userController.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/reviewController.php";

$debug = 0;
?>
<?php
include_once(ROOT_PATH . "/includes/header.php");

if (!defined('ROOT_PATH')) {
    include("../config.php");
}
if (($_SESSION['IsSystemUser']) <> 1 and $_SESSION['IsEmployee'] <> 1) {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=/WWI/WWI/pages/index.php\" />";
}

$stockitemID = filter_input(INPUT_GET, "StockItemID");




$sarray = getProductSpecificReviewByStockItemID($stockitemID);


?>
    <br>
    <table>
        <tr>
            <th>ProductID</th>
            <th>Gebruiker</th>
            <th>Reviews</th>
            <th>Delete</th>
        </tr>

        <?php

        $stockitems = getAllStockItems();
        foreach ($sarray as $reviews) {


            echo("  
                <tr>
                <td>" . $reviews['StockItemID'] . "</td>
                <td>" . $reviews['PersonID'] . "</td>
                <td>" . $reviews['Waarde'] . "</td>
                <td>
                <form method='post' class=\"form - inline my - 2 my - lg - 0\">
                <input type='hidden' value='TRUE' name='delete'>
                <input type='hidden' value='" .$reviews['StockItemID'] ."' name='StockID'>
                <input type='hidden' value='" .$reviews['PersonID'] ."' name='PersoonID'>
                <input type='hidden' value='" .$reviews['Waarde'] ."' name='Waarde'>
                <button class=\"btn btn - sample btn - sample - success\" type=\"submit\">Delete
                </button>
                </form>
                </td>
                </tr>");
        }
            $delete = filter_input(INPUT_POST, "delete");
        $stockitemID = filter_input(INPUT_POST, "StockID");
        $persoonid = filter_input(INPUT_POST, "PersoonID");
            $reviewwaarde = filter_input(INPUT_POST, "Waarde");
            if ($delete == "TRUE") {
                deletereview($persoonid,$stockitemID,$reviewwaarde);
                echo "<meta http-equiv=\"refresh\" content=\"0; url=/WWI/WWI/pages/Beheerreview.php?StockItemID=" . $stockitemID . "\"  />";



            }








        ?>
    </table>

    <br>

<?php include(ROOT_PATH . "/includes/footer.php"); ?>