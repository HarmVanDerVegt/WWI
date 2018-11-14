<?php
if (!defined('ROOT_PATH')) {
    include("../../config.php");
}

// Hier worden de verschillende controllers ingevoegd.
include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/supplierController.php";
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";
include_once ROOT_PATH . "/controllers/colorController.php";
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
        $StockItem = getStockItemByID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
        $StockItemName = $StockItem["StockItemName"];
        $Supplier = getSupplierByID($StockItem["SupplierID"]);
        $Color = getColorsByID($StockItem["ColorID"]);
        $Stock = getStockItemHoldingByID($StockItem["StockItemID"]);
        $StockGroup = getStockGroupIDByStockItemID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
        $StockGroupID = $StockGroup["StockGroupID"];
        // Checkt of er daadwerkelijk een product is meegegeven en redirect anders naar een errorpagina.

        $errorpagina = "../error.php";

        if ($StockItem["StockItemID"] == NULL || 0) {
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $errorpagina . '">';
        }

        // Maakt product_specs aan zodat er dingen aan toegevoegd kunnen worden om weer te geven
        $product_specs = "";

        // verzamel data van product
        // Naam van het product
        $product_naam = $StockItemName;

        // Indien het merk bekend is, verandert $product_merk in het merknaam. Anders is deze NULL
        if ($StockItem["Brand"] != NULL) {
            $product_merk = $StockItem["Brand"];
            $product_specs .= ("Merk " . $product_merk . "<br>");
        } else {
            $product_merk = FALSE;
        }

        // Indien de grootte bekend is, verandert $product_grootte in de grootte. Anders is deze NULL
        if ($StockItem["Size"] != NULL) {
            $product_grootte = $StockItem["Size"];
            $product_specs .= ("Dit product is " . $product_grootte . "<br>");
        } else {
            $product_grootte = NULL;
        }

        // Gemiddelde gewicht per eenheid van het product.
        $product_gewicht = $StockItem["TypicalWeightPerUnit"];
        if ($product_gewicht != NULL) {
            $product_specs = ("Het gewoonlijke gewicht per eenheid is: ");
            if ($product_gewicht >= 1 || $product_gewicht > ceil($product_gewicht) && $product_gewicht < ceil($product_gewicht)) {
                $product_specs .= (round($product_gewicht, 1) . " kilo" . "<br>");
            } elseif ($product_gewicht >= 1) {
                $product_specs .= ($product_gewicht . " kilo" . "<br>");
            } else {
                $product_specs .= ($product_gewicht . " gram" . "<br>");
            }
        }

        // Indien de kleur bekend is, verandert $product_kleur naar de kleur. Anders is deze NULL
        if ($Color["ColorName"] != NUlL) {
            $product_kleur = $Color["ColorName"];
            $product_specs .= ("Dit product is " . $product_kleur . "<br>");
        } else {
            $product_kleur = NULL;
        }

        // Indien er opmerkingen voor het product vanuit marketing zijn zullen deze in de variabele $marketing_commentaar gestopt worden.
        if ($StockItem["MarketingComments"] != NULL) {
            $marketing_commentaar = $StockItem["MarketingComments"];
            $product_specs .= ($marketing_commentaar . "<br>");
        } else {
            $marketing_commentaar = NULL;
        }

        // Indien het gekozen product een koelproduct is, word $product_is_koelproduct TRUE. Anders is deze FALSE.
        if ($StockItem["IsChillerStock"] == TRUE) {
            $product_specs .= ("Dit is een koelproduct" . "<br>");
        } else {
            $product_is_koelproduct = FALSE;
        }

        // De leverancier van het gekozen product.
        $product_leverancier = $Supplier["SupplierName"];

        // JN - NOG KIJKEN NAAR IMPLEMENTATIE DATABASE.
        // JN - WACHTEN OP TOEVOEGING BLOB DATABASE.
        $product_afbeelding_path = "../media/noveltyitems.jpg";
        $product_review = "dit is een review";
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
                            // Indien de voorraad meer dan 0 is, is er voorraad, verandert $product_voorraad naar de voorraad. Anders is deze NULL
                            if ($Stock["QuantityOnHand"] > 0) {
                                $product_voorraad = $Stock["QuantityOnHand"];
                                print("<b>voorraad: </b>" . $product_voorraad) . " eenheden " . "<br>";
                            } else {
                                $product_voorraad = NULL;
                                print("Dit product is momenteel niet op voorraad");
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            // Indien de voorgestelde prijs bekend is, verandert $product_prijs in de prijs. Indien deze niet bekend is pakt hij de vaste waarden binnen de UnitPrice en vermenigvuldigt hij deze met het TaxRate percentage.
                            if ($StockItem["RecommendedRetailPrice"] != NULL) {
                                $product_prijs = $StockItem["RecommendedRetailPrice"];
                                print("<b>Prijs: </b>€" . $product_prijs . "<br>");
                            } else {
                                $product_prijs = $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 1);
                                print("<b>Prijs: </b>€" . $product_prijs . "<br>");
                            }
                            if ($product_prijs == NULL) {
                                print("Er is geen prijs voor dit product beschikbaar" . "<br>");
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

            <!-- Toont product reviews -->
            <div class="row">
                <div class="col-sm-8" >
                    <div class="bg-light card">
                        <h4>Reviews:</h4>
                        <p><?php print($product_review); ?></p>
                    </div>
                </div>
            </div>

            <!-- Selecteert combideals -->
<?php
            $CombiDeals = getStockItemsByStockGroupID($StockGroupID);
            
            $hoogsteID = 0;
            foreach ($CombiDeals as $stockItem){
                if ($stockItem["StockItemID"] > $hoogsteID){
                    $hoogsteID = $stockItem["StockItemID"];
                }
            }
            
            $laagsteID = $hoogsteID;
            foreach ($CombiDeals as $stockItem) {
                if ($stockItem["StockItemID"] < $laagsteID) {
                    $laagsteID = $stockItem["StockItemID"];
                }
            }
            
            $CombiDeal1ID = rand($laagsteID, $hoogsteID);
            $CombiDeal1Naam = $CombiDeals[$CombiDeal1ID]["StockItemName"];
            $CombiDeal2ID = rand($laagsteID, $hoogsteID);
            $CombiDeal2Naam = $CombiDeals[$CombiDeal2ID]["StockItemName"];
            $CombiDeal3ID = rand($laagsteID, $hoogsteID);
            $CombiDeal3Naam = $CombiDeals[$CombiDeal3ID]["StockItemName"];
?>
            <!-- Toon combideals -->
            <div class="row">
                <div class="col-lg-8" >
                    <div class="bg-light card">
                        <h4>Combideals:</h4>
                        <p> Misschien zijn deze producten een leuke combinatie met dit product? </p>
                        <div class="card-group">
                            <div class="card">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"> <?php print($CombiDeal1Naam) ?> </h5>
                                    <a href="product.php?productID=<?php print($CombiDeal1ID) ?> ">
                                </div>
                            </div>
                            <div class="card">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"> <?php print($CombiDeal2Naam) ?> </h5>
                                    <a href="product.php?productID=<?php print($CombiDeal2ID) ?> ">
                                </div>
                            </div>
                            <div class="card">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"> <?php print($CombiDeal3Naam) ?> </h5>
                                    <a href="product.php?productID=<?php print($CombiDeal3ID) ?> ">
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
