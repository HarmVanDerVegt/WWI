<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once(ROOT_PATH . "/controllers/stockGroupsController.php");

?>


<form action="zoekfunctie.php" method="get">
    <table>
        <tr>
            <td>naam :</td>
            <td><input type="text" name="naam"></td>
        </tr>
        <tr>
            <td>    <?php foreach (getSearchTags() as $tag) {
                    echo("<input type=\"checkbox\" name=\"tag\" value=\"$tag->$tag\"><br>");
                } ?>
            </td>
        </tr>
        <tr>
            <td>Categorieën :</td>
            <td><select>
                    <?php foreach (getAllStockGroups() as $categorie) {
                        echo("<option name='categorie' value=" .$categorie["StockGroupID"] . ">" . $categorie["StockGroupName"] . "</option>");
                    } ?></select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="opslaan" class="btn btn-sample"></td>
        </tr>

    </table>
</form>
<?php
if (isset($_GET["naam"])) {
    if (isset($_GET["tag"])) {
        if (isset($_GET["categorie"])) {
            $producten = getSearchedItems($_GET["naam"], $_GET["tag"], $_GET["categorie"]);

            print_r($producten);

            foreach ($producten as $product) {
                echo "<p>" . $product["StockItemName"] . "</p>";
            }

            if (empty($producten)) {
                echo "<p>Geen producten gevonden</p>";
            }
        }
    }
}

?>