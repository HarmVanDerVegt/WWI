<?php
if (!defined('ROOT_PATH')) {
    include("../../config.php");
}

// Hier worden de verschillende controllers ingevoegd.
include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/productController2.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <title>Category</title>
    </head>
    <body>
        <!-- constanten -->

        <?php
        $StockItem = getStockItemByID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
        $StockItemName = $StockItem["StockItemName"];
        $height = 200;
        $width = 300;
        $product_specs = generateProductPageInformation($StockItem);
        $product_prijs = generatePrice($StockItem);
        $product_stock = generateStock($StockItem);
        $product_afbeelding_path = generatePhoto($StockItem);
        $product_review = generateReviews($StockItem);

        // sessie laden
        $i = filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT);
        if (!isset($_SESSION["total"])) {
            $_SESSION["total"] = 0;
            $_SESSION["qty"][$i] = 0;
            $_SESSION["amounts"][$i] = 0;
        }
        // Checkt of er daadwerkelijk een product is meegegeven en redirect anders naar een errorpagina.

        $errorpagina = "../error.php";

        if ($StockItem["StockItemID"] == NULL || 0) {
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $errorpagina . '">';
        }

// verzamel data van product

        // Naam van het product
        $product_naam = $StockItemName;
        ?>

        <!-- Header naam, merk, prijs, voorraad -->
        <div class="card">
            <div class="card-body">
                <!-- Toon naam van product -->
                <div class="card-header">
                    <td><h1><?php print($product_naam); ?></h1></td>
                </div>
                <table>
                    <!-- Toon de globale informatie van product -->
                    <tr>
                        <td>
                            <?php
                            // Toont de reviews
                            ?>
                            <div class="container">
                                <div class="row col-3 no-gutters">
                                    <?php print($product_review); ?>
                                </div>
                            </div>
                        </td>
                        <!-- bestel knop -->
                        <td>
                            <form method="post" action="/WWI/WWI/pages/ShoppingCart.php">
                                <input type="hidden" value="<?php echo($i); ?>" name="add">
                                <tr>
                                    <td width="10px">&nbsp;</td>
                                    <td><?php echo("&euro; " . $product_prijs . " euro"); ?></td>
                                    <td width="10px">&nbsp;</td>
                                    <td><input type="number" name="hoeveelheid" min="1" max="<?php print($product_voorraad) ?>" required></td>
                                    <td width="10px">&nbsp;</td>
                                    <td><input type="submit"  class="btn btn-sample btn-sample-success btn-block" value="Toevoegen aan winkelwagen"></td>
                                </tr>
                            </form>
                        </td>
                    </tr>
                    <!-- Toon product afbeelding -->
                    <tr>
                        <td>
                            <img class="img-thumbnail" src="<?php print($product_afbeelding_path); ?>"
                                 alt="Afbeelding <?php print($product_naam); ?>" height="<?php print($height); ?>px"
                                 width="<?php print($width); ?>px"/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <!-- product informatie weergeven-->
        <div class="row">
            <div class="col-sm-8">
                <div class="bg-light card">
                    <h4>Productinformatie:</h4>
                    <p><?php print($product_specs); ?></p>
                </div>
            </div>
        </div>

        <!-- Selecteert combideals -->
        <?php
//Krijg de categorieën van het getoonde item, dit kunnen er meerdere zijn.
        $SpecialDealStockGroups = getStockGroupIDsFromStockItemID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));

//Verkrijg 1 random geselecteerde categorie van de gegeven categorieën bij de vorige stap.
        $SpecialDealSingleStockGroup = array_rand($SpecialDealStockGroups, 1);

//Van deze geselecteerde categorie halen we alle stock items op.
        $CombiDeals = getStockItemsByStockGroupID($SpecialDealStockGroups[$SpecialDealSingleStockGroup]);

//Van alle stockitems binnen dezelfde categorie als het getoonde item worden nu drie willekeurige producten getoond.
        $CombiDealRand1 = array_rand($CombiDeals, 1);
        $CombiDeal1ID = $CombiDeals[$CombiDealRand1]["StockItemID"];
        $CombiDeal1Naam = $CombiDeals[$CombiDealRand1]["StockItemName"];

        $CombiDealRand2 = array_rand($CombiDeals, 1);
        $CombiDeal2ID = $CombiDeals[$CombiDealRand2]["StockItemID"];
        $CombiDeal2Naam = $CombiDeals[$CombiDealRand2]["StockItemName"];

        $CombiDealRand3 = array_rand($CombiDeals, 1);
        $CombiDeal3ID = $CombiDeals[$CombiDealRand3]["StockItemID"];
        $CombiDeal3Naam = $CombiDeals[$CombiDealRand3]["StockItemName"];

        $firstLink = getImageLinkFromStockGroupID($SpecialDealStockGroups[$SpecialDealSingleStockGroup]);
        $secondLink = getImageLinkFromStockGroupID($SpecialDealStockGroups[$SpecialDealSingleStockGroup]);
        $thirdLink = getImageLinkFromStockGroupID($SpecialDealStockGroups[$SpecialDealSingleStockGroup]);
        ?>
        <!-- Toon combideals -->
        <div class="row">
            <div class="col-lg-8">
                <div class="bg-light card">
                    <h4>Combideals:</h4>
                    <p> Misschien zijn deze producten een leuke combinatie met dit product? </p>
                    <div class="card-group">
                        <div class="card">
                            <img class="card-img-top" height="<?php print($height); ?>px" width="<?php print($width); ?>px" src="<?php print $firstLink ?>" alt="Afbeeldig mist">
                            <div class="card-body">
                                <a href="product.php?productID=<?php print($CombiDeal1ID) ?> ">
                                    <h5 class="card-title"> <?php print($CombiDeal1Naam) ?> </h5>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" height="<?php print($height); ?>px" width="<?php print($width); ?>px" src="<?php print $secondLink ?>" alt="Afbeelding mist">
                            <div class="card-body">
                                <a href="product.php?productID=<?php print $CombiDeal2ID ?> ">
                                    <h5 class="card-title"> <?php print($CombiDeal2Naam) ?> </h5>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" height="<?php print($height); ?>px" width="<?php print($width); ?>px" src="<?php print $thirdLink ?>" alt="Afbeelding mist">
                            <div class="card-body">
                                <a href="product.php?productID=<?php print $CombiDeal3ID ?> ">
                                    <h5 class="card-title"> <?php print($CombiDeal3Naam) ?> </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!-- voeg footer toe -->
        <br>
        <?php include(ROOT_PATH . "/includes/footer.php"); ?>
    </body>
</html>