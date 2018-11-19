<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once(ROOT_PATH . "/controllers/stockGroupsController.php");

?>

<table>
<form action="zoekfunctie.php" method="get">
<tr>
    <td>naam : </td><td><input type="text" name="naam" "></td>
</tr>
<tr><td>    <?php foreach (getSearchTags() as $tag){
        echo ("<input type=\"checkbox\" name=\"tag\" value=\"$tag->$tag\"><br>");
    }?>
</td></tr>
<tr>
    <td>Categorieën :</td>
        <td><select>
            <?php foreach(getAllStockGroups() as $categorie) {
            echo("<option name='categorie' value='" . $categorie["StockGroupID"] . "'>" . $categorie["StockGroupName"] . "</option>");
            }?></select>
    </td>
</tr>
<tr>
    <td><input type="submit" value="opslaan" class="btn btn-sample"></td>
</tr>
</form>
</table>

<?php
if (isset($_GET["naam"])){
    if (isset($_GET["tag"])){
        if (isset($_GET["categorie"])){
            $producten = getSearchedItems($_GET["naam"], $_GET["tag"], $_GET["categorie"]);

            foreach ($producten as $product){
                echo "<p>" . $product["StockItemName"] . "</p>";
            }

            if (empty($producten)){
                echo "<p>Geen producten gevonden</p>";
            }
        }
    }
}

?>