<?php
if (!defined('ROOT_PATH')) {
    include("../../config.php");
}

// Hier worden de verschillende controllers ingevoegd.
include(ROOT_PATH . "/includes/header.php"); // <---
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/supplierController.php";
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";
include_once ROOT_PATH . "/controllers/colorController.php";
include_once ROOT_PATH . "/controllers/redirect.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="\WWI\WWI\css\bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <title>Category</title>
    </head>
    <body>
        <!-- constanten -->
        <?php
        $height = 200;
        $width = 300;
        //$StockItem = getStockItemByID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
        $StockItem = getStockItemByID(rand(1, 200));
        $StockItemName = $StockItem["StockItemName"];
        $Supplier = getSupplierByID($StockItem["SupplierID"]);
        $Color = getColorsByID($StockItem["ColorID"]);
        $Stock = getStockItemHoldingByID($StockItem["StockItemID"]);

        // Checkt of er daadwerkelijk een product is meegegeven en redirect anders naar een errorpagina.

        $errorpagina = "../error.php";

        $ProductID = getStockItemByID(42);
        if ($ProductID == NULL || 0) {
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $errorpagina . '">';
        }

        // verzamel data van product
        // Naam van het product
        $product_naam = $StockItemName;

        // Indien het merk bekend is, verandert $product_merk in het merknaam. Anders is deze NULL
        if ($StockItem["Brand"] != NULL) {
            $product_merk = $StockItem["Brand"];
        } else {
            $product_merk = FALSE;
        }

        // Indien de grootte bekend is, verandert $product_grootte in de grootte. Anders is deze NULL
        if ($StockItem["Size"] != NULL) {
            $product_grootte = $StockItem["Size"];
        } else {
            $product_grootte = NULL;
        }

        // Gemiddelde gewicht per eenheid van het product.
        $product_gewicht = $StockItem["TypicalWeightPerUnit"];

        // Indien de voorgestelde prijs bekend is, verandert $product_prijs in de prijs. Indien deze niet bekend is pakt hij de vaste waarden binnen de UnitPrice en vermenigvuldigt hij deze met het TaxRate percentage.
        if ($StockItem["RecommendedRetailPrice"] != NULL) {
            $product_prijs = $StockItem["RecommendedRetailPrice"];
        } else {
            $product_prijs = $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 1);
        }

        // Indien de kleur bekend is, verandert $product_kleur naar de kleur. Anders is deze NULL
        if ($Color["ColorName"] != NUlL) {
            $product_kleur = $Color["ColorName"];
        } else {
            $product_kleur = NULL;
        }

        // Indien de voorraad meer dan 0 is, is er voorraad, verandert $product_voorraad naar de voorraad. Anders is deze NULL
        if ($Stock["QuantityOnHand"] > 0) {
            $product_voorraad = $Stock["QuantityOnHand"];
        } else {
            $product_voorraad = NULL;
        }

        // Indien er opmerkingen voor het product vanuit marketing zijn zullen deze in de variabele $marketing_commentaar gestopt worden.
        if ($StockItem["MarketingComments"] != NULL) {
            $marketing_commentaar = $StockItem["MarketingComments"];
        } else {
            $marketing_commentaar = NULL;
        }

        // Indien het gekozen product een koelproduct is, word $product_is_koelproduct TRUE. Anders is deze FALSE.
        if ($StockItem["IsChillerStock"] == TRUE) {
            $product_is_koelproduct = TRUE;
        } else {
            $product_is_koelproduct = FALSE;
        }

        // De leverancier van het gekozen product.
        $product_leverancier = $Supplier["SupplierName"];

        // JN - NOG KIJKEN NAAR IMPLEMENTATIE DATABASE.
        // JN - WACHTEN OP TOEVOEGING BLOB DATABASE.
        $product_afbeelding_path = "../media/noveltyitems.jpg";


        $product_specs = "veel dingen";
        $product_beschrijving = "het is een beschrijving";
        $product_review = "dit is een revieuw";
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
                        <!-- toon merk van product -->
                        <td>
                            <?php
                            if ($product_merk != NULL) {
                                print("<b>Merk:</b>" . $product_merk . "<br>");
                            } else {
                                print("Dit is geen merkproduct." . "<br>");
                            }
                            ?>
                        </td>
                        <!-- toon prijs van het product-->
                        <td>
                            <?php
                            if ($product_prijs != NULL) {
                                print("<b>Prijs: </b>€" . $product_prijs . "<br>");
                            } else {
                                print("Er is geen prijs voor dit product beschikbaar" . "<br>");
                            }
                            ?>
                        </td>
                        <!-- Toont de grootte van een product en laat het weg als deze er niet is. -->
                        <td>
                            <?php
                            if ($product_grootte != NULL) {
                                print("Dit product is " . $product_grootte . "<br>");
                            }
                            ?>
                        </td>
                        <!-- Toon of het product een gespecificieerde kleur heeft -->
                        <td>
                            <?php
                            if ($product_kleur != NUlL) {
                                print("Dit product is " . $product_kleur . "<br>");
                            }
                            ?>
                        </td>
                        <!-- Toon of er voorraad van het product is -->
                        <td>
                            <?php
                            if ($product_voorraad != NULL) {
                                print("<b>voorraad: </b>" . $product_voorraad) . " eenheden " . "<br>";
                            } else {
                                print("Dit product is momenteel niet op voorraad");
                            }
                            ?>
                        </td>
                        <!-- Toont eventuele marketing commentaar -->
                        <td>
                            <?php
                            if ($marketing_commentaar != NULL) {
                                print($marketing_commentaar);
                            }
                            ?>
                        </td>
                        <!-- Indien dit een koelproduct is, word dit aangegeven. -->
                        <td>
                            <?php
                            if ($product_is_koelproduct == TRUE) {
                                print("Dit is een koelproduct");
                            }
                            ?>
                        </td>
                        <!-- bestel knop -->
                        <td>
                            <form>
                                <input type="submit" value="bestellen">
                            </form>
                        </td>
                    </tr>
                    <!-- Toon product afbeelding -->
                    <tr>
                        <td>
                            <img class="img-thumbnail" src="<?php print($product_afbeelding_path); ?>" alt="Afbeelding <?php print($product_naam); ?>" height="<?php print($height); ?>px" width="<?php print($width); ?>px" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <!-- product informatie weergeven-->
        <div class="container-fluid">

            <!-- Toon specificaties -->
            <div class="row">
                <div class="col-sm-8">
                    <div class="bg-light card">
                        <h4>Specs:</h4>
                        <p><?php print($product_specs); ?></p>
                    </div>
                </div>
            </div>

            <!-- toon product beschrijving -->
            <div class="row">
                <div class="col-sm-8" >
                    <div class="bg-light  card">
                        <h4>Product beschrijving:</h4>
                        <p><?php print($product_beschrijving); ?></p>
                    </div>
                </div>
            </div>

            <!-- Toont product reviews -->
            <div class="row">
                <div class="col-sm-8" >
                    <div class="bg-light card">
                        <h4>revieuws:</h4>
                        <p><?php print($product_review); ?></p>
                    </div>
                </div>
            </div>

            <!-- toon combi deals -->
            <div class="row">
                <div class="col-lg-8" >
                    <div class="bg-light card">
                        <h4>combideals:</h4>
                        <p>test</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- voeg footer toe -->
        <br>
        <?php include(ROOT_PATH . "/includes/footer.php"); ?>
    </body>
</html>
