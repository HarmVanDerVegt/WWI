<?php
/**
 * Created by PhpStorm.
 * User: lexkruiper97
 * Date: 30-11-2018
 * Time: 14:21
 */


if (!defined('ROOT_PATH')) {
    include_once("../config.php");
}

include_once ROOT_PATH . "/controllers/databaseController.php";
include_once ROOT_PATH . "/controllers/userController.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";

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
?>
    <center>
        <table>
            <tr>
                <th>ProductID</th>
                <th>Productnaam</th>
                <th>Reviews</th>
            </tr>
            <?php
            $stockitems = getAllStockItems();
            foreach ($stockitems as $stockarray) {


                echo("  
                <tr>
                <td>" . $stockarray['StockItemID'] . "</td>
                <td>" . $stockarray['StockItemName'] . "</td>
                <td><a href=\"/WWI/WWI/pages/Beheerreview.php?StockItemID=" . $stockarray['StockItemID'] . "\"><h4 class=\"card-custom-title \"> beheer </h4></a></td>
                </tr>");


            }


            ?>
        </table>
    </center>
    <br>


<?php include(ROOT_PATH . "/includes/footer.php"); ?>