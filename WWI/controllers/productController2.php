<?php

// Hier worden de verschillende controllers ingevoegd.
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/supplierController.php";
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";
include_once ROOT_PATH . "/controllers/colorController.php";
include_once ROOT_PATH . "/controllers/specialDealsController.php";
include_once ROOT_PATH . "/controllers/reviewController.php";

// Constanten

$StockItem = getStockItemByID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
$height = 200;
$width = 300;
$StockItemID = $StockItem["StockItemID"];
$Supplier = getSupplierByID($StockItem["SupplierID"]);
$Color = getColorsByID($StockItem["ColorID"]);
$Stock = getStockItemHoldingByID($StockItem["StockItemID"]);
$StockGroup = getStockGroupByStockItemID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
$StockGroupID = $StockGroup["StockGroupID"];
$SpecialDealStockItemID = array_column(getSpecialDealByStockItemID($StockItemID), "StockItemID");

function generateProductPageInformation($StockItem) {
    // Maakt product_specs aan zodat er dingen aan toegevoegd kunnen worden om weer te geven
    $product_specs = "";

    // Verzamel data van product
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
    if ($Color["ColorName"] != NULL) {
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
    if ($Supplier["SupplierName"] != NULL) {
        $product_supplier = $Supplier["SupplierName"];
        $product_specs .= ("Dit product word geleverd door " . $product_supplier . "<br>");
    } else {
        $product_supplier = NULL;
    }

    return $product_specs;
}

function generateDiscountPercentage() {
    $DiscountPercentage = 0;
    if ($SpecialDealStockItemID != NULL) {
        if ($SpecialDealStockItemID[0] == $StockItemID) {
            $SpecialDealInfo = getSpecialDealByStockItemID($StockItemID);
            $DiscountPercentage = array_column($SpecialDealInfo, "DiscountPercentage");
            $DiscountPercentage = (int) $DiscountPercentage[0];
        }
    }
    return $DiscountPercentage;
}

function generateDiscountTextIfApplicable($StockItem) {
    $DiscountPercentage = generateDiscountPercentage();
    if ($DiscountPercentage != NULL && $DiscountPercentage != 0) {
        $product_discount_text = ("Dit product is in de aanbieding! Er is een kortingspercentage van " . $DiscountPercentage . " procent over dit product verwerkt!");
    }
}

function generatePrice($StockItem) {

    // Indien de voorgestelde prijs bekend is, verandert $product_prijs in de prijs. Indien deze niet bekend is pakt hij de vaste waarden binnen de UnitPrice en vermenigvuldigt hij deze met het TaxRate percentage.
    // Tevens checkt deze functie of het product in de aanbieding is en past dit toe.

    $DiscountPercentage = generateDiscountPercentage();

    if ($StockItem["RecommendedRetailPrice"] != NULL) {
        if ($DiscountPercentage != NULL && $DiscountPercentage != 0) {
            $product_prijs = number_format(($StockItem["RecommendedRetailPrice"] / 100 * ( 100 - $DiscountPercentage)), 2);
        } else {
            $product_prijs = number_format($StockItem["RecommendedRetailPrice"], 2);
        }
    } elseif ($StockItem["RecommendedRetailPrice"] == NULL && $DiscountPercentage != (NULL || 0)) {
        $product_prijs = number_format(($StockItem["UnitPrice"] * $StockItem["TaxRate"] / 100 + 1) / 100 * ( 100 - $DiscountPercentage), 2);
    } else {
        $product_prijs = ("Er is geen prijs voor dit product beschikbaar" . "<br>");
    }

    return $product_prijs;
}

function generateStock($StockItem) {
// Indien de voorraad meer dan 0 is, is er voorraad, verandert $product_voorraad naar de voorraad. Anders is deze NULL
    if ($Stock["QuantityOnHand"] > 0) {
        $product_voorraad = $Stock["QuantityOnHand"];
        $product_voorraad = ("<b>voorraad: </b>" . $product_voorraad) . " eenheden " . "<br>";
    } else {
        $product_voorraad = NULL;
        $product_voorraad = ("Dit product is momenteel niet op voorraad");
    }

    return $product_voorraad;
}

function generatePhoto($StockItem) {
    $StockGroups = getStockGroupIDsFromStockItemID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
    $SingleStockGroup = array_rand($StockGroups, 1);
    $product_afbeelding_path = getImageLinkFromStockGroupID($StockGroups[$SingleStockGroup]);

    return($product_afbeelding_path);
}

function generateReviews($StockItem) {
    $product_review = filter_input(INPUT_POST, "ster", FILTER_VALIDATE_INT);
    if (empty($product_review)) {
        $product_review = 3;
    }

    $product_review = getCurrentReviewValue($review);

    return $product_review;
}

function generateCombiDealCards($combiDeals){

    $html = "";

    $html .= "<div class='card-group'>";

    foreach ($combiDeals as $combiDeal){

        //$category = array_rand(getStockGroupIDsFromStockItemID($combiDeal["StockItemID"]));
        $category = $combiDeal["StockGroupID"];

        $link = getImageLinkFromStockGroupID($category);

        $html .= "<div class='card'>";
        $html .= "<img class='card-img-top'
                        height='200px' width='300px'
                        src='" . $link . "'
                        alt='Afbeelding mist'>";
        $html .= "<div class='card-body'>";
        $html .= "<a href='category/product.php?productID=" . $combiDeal["StockItemID"] . "'>";
        $html .= "<h5 class='card-title>" . $combiDeal["StockItemName"] . "</h5>";
        $html .= "</a>";
        $html .= "</div>";
        $html .= "</div>";
    }
    //$html .="</div>";

    return $html;
}

function generateCombiDeals($stockItem){

    //Haal alle categories van dit product op.
    $categories = getStockGroupIDsFromStockItemID($stockItem["StockItemID"]);

    //Kies een willekeurige categorie uit.
    $singleCategoryKey = array_rand($categories);

    $singleCategory = $categories[$singleCategoryKey];

    //Haal alle producten op van deze categorie.
    $categoryItems = getStockItemsByStockGroupID($singleCategory);

    //Haal 3 producten op uit deze categorie.
    $combiDealsID = array_rand($categoryItems, 3);

    $combiDeals = [];

    foreach ($combiDealsID as $combiDeal){
        $combiDeals []= $categoryItems[$combiDeal];
    }

    return $combiDeals;
}
