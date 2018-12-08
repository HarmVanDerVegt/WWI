<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/photoController.php";
include_once ROOT_PATH . "/controllers/stockGroupsController.php";
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

$categories = getAllStockGroups();

?>
    <link href="\WWI\WWI\css\card.css" rel="stylesheet" type="text/css"/>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-6">
                <form>
                    <table>
                        <tr>
                            <th>Naam:</th>
                            <th>Tags</th>
                            <th>Categorie</th>
                        </tr>
                        <tr>

                            <td><input type="search" name="name" value='<?php echo $_GET['name'] ?>'/></td>
                            <td><select name='tag[]' multiple>
                                    <?php foreach (getSearchTags() as $tag) {
                                        echo "<option   value='$tag'>$tag</option>";
                                    } ?>
                                </select></td>
                            <td><select name="categoryID">
                                    <?php foreach (getAllStockGroups() as $category) {
                                        echo("<option  value='" . $category["StockGroupID"] . "'>" . $category["StockGroupName"] . "</option>");
                                    } ?>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-sample btn-sample-success">Zoeken</button>

                            </td>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php

//if (isset($_GET["name"])){
//    echo "<p>" . $_GET["name"] . "</p>";
//}

//if (isset($_GET["tag"])){
//    echo "<p>";
//    print_r($_GET["tag"]);
//    echo "</p>";
//}

if (!isset($_GET["name"])) {
    $_GET["name"] = "";
}

if (!isset($_GET["tag"])) {
    $_GET["tag"] = [];
}

if (!isset($_GET["categoryID"])) {
    $_GET["categoryID"] = [];
}

$items = getSearchedItems($_GET["name"], $_GET["tag"], $_GET["categoryID"]);

if (empty($_GET["name"]) && empty($_GET["tag"]) && empty($_GET["categoryID"])) {
    echo 'Vul op ten minste een veld in';
} else {
    echo("

    <div class=\"py-2\">
        <div class=\"container\">
            <div class=\"row hidden-md-up\">");

    $loop = 0;

    foreach ($items as $item) {
        // laad gegevens van een rij


        // --------------------------doe benodige gegevens in variablen
        $naam = explode("_", $item["StockItemName"]);
        if ($item["RecommendedRetailPrice"] != NULL) {
            $prijs = $item["RecommendedRetailPrice"];
        } else {
            $prijs = $item["UnitPrice"] * ($item["TaxRate"] / 100 + 1);
        }
        if ($prijs == NULL) {
            print("Er is geen prijs voor dit product beschikbaar" . "<br>");
        }
        $merk = $item["Brand"];
        $gewicht = $item["TypicalWeightPerUnit"];
        $product_id = $item["StockItemID"];

        // -------------------------- Zoek een productfoto
        $StockGroups = getStockGroupIDsFromStockItemID($product_id);
        $SingleStockGroup = array_rand($StockGroups, 1);
        //$product_afbeelding_path = getImageLinkFromStockGroupID($StockGroups[$SingleStockGroup]);
        $a = laad_afbeelding($product_id);
        $product_afbeelding_path = "data:image/jpeg;base64," . array_pop($a);

        // -------------------------ga naar een nieuwe rij na elke 3 items

        if ($loop % 3 == 0) {
            print('</div></div></div><div class="py-2"><div class="container"><div class="row hidden-md-up">');
        }

        // ---------------------------------------maak een kaart
        print('<div class="col-md-4">
						     <div class="card-custom">
                               <div class="card-block">
                                 <a href="/WWI/WWI/pages/category/product.php?productID=' . $product_id . '" class="card-link"><img class="card-img-top" src="' . $product_afbeelding_path . ' "  alt="Card image cap" style="max-width:382px;max-height:180px;" ></a>
                                 <a href="/WWI/WWI/pages/category/product.php?productID=' . $product_id . '"><h4 class="card-custom-title text-light">' . $naam[0] . '</h4></a>
                                 <p class="card-text p-y-1 text-light"> €' . $prijs . '</p>
                               </div>
                             </div>
                           </div>');
        $loop++;
    }
    echo("</div>
                      </div>
                     </div>");
}
?>


<?php

if (empty($items)) {
    echo "<p>Geen producten gevonden</p>";
}

?>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>