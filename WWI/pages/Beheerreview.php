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


?><center>
    <br>
    <link href="\WWI\WWI\css\button.css" rel="stylesheet" type="text/css"/>
<?php $arraystock = (getStockItemByID($stockitemID)); echo ($arraystock['StockItemName']) ; ?>
    <br>
    <table>
        <tr>
            <th>Gebruiker</th>
            <th>Reviews</th>
            <th>Delete</th>
        </tr>

        <?php

        $stockitems = getAllStockItems();
        foreach ($sarray as $reviews) {
            if ($reviews['Waarde'] <= 1 and $reviews['Waarde'] >= 5) {
                deletereview($reviews['PersonID'],$reviews['StockItemID'],$reviews['Waarde']);
                echo "<meta http-equiv=\"refresh\" content=\"0; url=/WWI/WWI/pages/Beheerreview.php?StockItemID=" . $stockitemID . "\"  />";

            }

            echo("  
                <tr>
                <td>" . $reviews['PersonID'] . "</td>
                <td>" . $reviews['Waarde'] . "</td>
                <td>
                <form method='post' class=\"form - inline my - 2 my - lg - 0\">
                <input type='hidden' value='TRUE' name='delete'>
                <input type='hidden' value='" .$reviews['StockItemID'] ."' name='StockID'>
                <input type='hidden' value='" .$reviews['PersonID'] ."' name='PersoonID'>
                <input type='hidden' value='" .$reviews['Waarde'] ."' name='Waarde'>
                <button class=\"btn btn - sample btn - sample - success\" onclick=\"return confirm('Weet u het zeker?');\" type=\"submit\">Delete</button>
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
    </center>
    <br>

<?php include(ROOT_PATH . "/includes/footer.php"); ?>