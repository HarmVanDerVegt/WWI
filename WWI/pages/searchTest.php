<?php
include_once "../controllers/stockItemController.php";
include_once "../controllers/stockGroupsController.php";

$categories = getAllStockGroups();

?>

<form action="searchTest.php" method="get">
    <p>Name: <input type="search" name="name"/> </p>
    <?php foreach (getSearchTags() as $tag){
        echo "<p><input type='checkbox' name='tag[]' value='$tag'>$tag</p>";
    } ?>
    <select name='categoryID'>
        <?php foreach (getAllStockGroups() as $category) {
            echo("<option value='" .$category["StockGroupID"] . "'>" . $category["StockGroupName"] . "</option>");
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