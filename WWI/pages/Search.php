<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once(ROOT_PATH . "/includes/header.php");
?>

<!--<!-- start zoekfunctie -->
<?php //$Search = (filter_input(INPUT_GET, "Zoeken", FILTER_SANITIZE_STRING));
//
//if (filter_input(INPUT_GET, "Zoeken", FILTER_SANITIZE_STRING) <> "") {
//    $sarray = getStockItemsBySearchDetails($Search);
//}
//?>
<!--<table class="table table-striped">-->
<!---->
<!--    <tr>-->
<!--        <th>Naam</th>-->
<!--        <th>Link</th>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        --><?php
//        if (empty($sarray)){
//            print "Niks gevonden.";
//        }
//        if (!empty($sarray)){
//            foreach($sarray as $item){ ?>
<!--        <td>--><?php //print $item["StockItemName"] ?><!--</td>-->
<!--        --><?php //print("<td>" . '<a href="/WWI/WWI/pages/category/product.php?productID=' . $item["StockItemID"] . '">Link</a></td>'); ?>
<!--    </tr>-->
<!--    --><?php //}
//    } ?>
<!--</table>-->
<!---->
<!---->
<!---->


<?php
include_once "../controllers/stockItemController.php";
include_once "../controllers/stockGroupsController.php";

$categories = getAllStockGroups();

?>

<br>

    <form action="Search.php" method="get">
        Name: <input type="search" name="name" value='<?php echo $_GET['name']?>'/> <br>
        <select name='tag[]' multiple>
        <?php foreach (getSearchTags() as $tag){
            echo "<option   value='$tag'>$tag</option>";
        } ?>
        </select> <br>
        <select name='categoryID'>
            <option value="" > Geen Categorie</option>
            <?php foreach (getAllStockGroups() as $category) {
                echo("<option  value='" .$category["StockGroupID"] . "'>" . $category["StockGroupName"] . "</option>");
            } ?>
        </select>
        <p><input type="submit"></p>
    </form>
<?php

//if (isset($_GET["name"])){
//    echo "<p>" . $_GET["name"] . "</p>";
//}

//if (isset($_GET["tag"])){
//    echo "<p>";
//    print_r($_GET["tag"]);
//    echo "</p>";
//}

if (!isset($_GET["name"])){
    $_GET["name"] = "";
}

if (!isset($_GET["tag"])){
    $_GET["tag"] = [];
}

if (!isset($_GET["categoryID"])){
    $_GET["categoryID"] = [];
}

$items = getSearchedItems($_GET["name"], $_GET["tag"], $_GET["categoryID"]);

foreach ($items as $item){
    echo "<p>" . $item["StockItemName"] . "</p>";
}

if (empty($items)){
    echo "<p>Geen producten gevonden</p>";
}

?>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>