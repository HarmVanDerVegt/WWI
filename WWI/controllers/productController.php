<?php

// Hier worden de verschillende controllers ingevoegd.
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/supplierController.php";
include_once ROOT_PATH . "/controllers/stockItemHoldingController.php";
include_once ROOT_PATH . "/controllers/colorController.php";
include_once ROOT_PATH . "/controllers/specialDealsController.php";
include_once ROOT_PATH . "/controllers/reviewController.php";
include_once ROOT_PATH . "/controllers/rpiTempController.php";

function generateProductPageInformation($StockItem)
{
    $StockItemID = $StockItem["StockItemID"];

    //Haal voorraad op. TODO: Doen we dit niet ergens anders?
    $Stock = getStockItemHoldingByID($StockItem["StockItemID"]);

    //Haal de category van het product op.
    $StockGroup = getStockGroupByStockItemID($StockItemID);
    $StockGroupID = $StockGroup["StockGroupID"];

    // Maakt product_specs aan zodat er dingen aan toegevoegd kunnen worden om weer te geven
    $product_specs = "";

    if (getBrand($StockItem) != null) {
        $product_specs .= "Merk: " . getBrand($StockItem) . "<br>";
    }

    if (getSize($StockItem) != null) {
        $product_specs .= "De grootte van dit product is: " . getSize($StockItem) . "<br>";
    }

    if (getWeight($StockItem) != null) {
        $product_specs .= "Het gewicht per eenheid is: " . getWeight($StockItem) . "<br>";
    }

    if (getColor($StockItem) != null) {
        $product_specs .= "De kleur van het product is: " . getColor($StockItem) . "<br>";
    }

    if (getMarketingComments($StockItem) != null) {
        $product_specs .= getMarketingComments($StockItem) . "<br>";
    }

    // Indien het gekozen product een koelproduct is, word $product_is_koelproduct TRUE. Anders is deze FALSE.
    //TODO: placeholder voor temperatuur
    if ($StockItem["IsChillerStock"] == TRUE) {
        $product_specs .= ("Temperatuur in koeling:" . gemiddelde_temperatuur() . "<br>");
    }

    if (getSupplier($StockItem) != null) {
        $product_specs .= "Dit product word geleverd door: " . getSupplier($StockItem) . "<br>";
    }

    return $product_specs;
}

function getSupplier($StockItem)
{
    $Supplier = getSupplierByID($StockItem["SupplierID"]);
    if ($Supplier != NULL) {
        $product_supplier = $Supplier["SupplierName"];
    } else {
        $product_supplier = NULL;
    }
    return $product_supplier;
}

function getMarketingComments($StockItem)
{
    if ($StockItem["MarketingComments"] != NULL) {
        $marketing_commentaar = $StockItem["MarketingComments"];
    } else {
        $marketing_commentaar = NULL;
    }
    return $marketing_commentaar;
}

function getColor($StockItem)
{
    $Color = getColorsByID($StockItem["ColorID"]);
    if ($Color != NULL) {
        $product_kleur = $Color["ColorName"];
    } else {
        $product_kleur = NULL;
    }
    return $product_kleur;
}

function getWeight($StockItem)
{
    $product_gewicht = $StockItem["TypicalWeightPerUnit"];
    $gewicht_tekst = "";
    if ($product_gewicht != NULL) {
        if ($product_gewicht >= 1 || $product_gewicht > ceil($product_gewicht) && $product_gewicht < ceil($product_gewicht)) {
            $gewicht_tekst .= (round($product_gewicht, 1) . " kilo" . "<br>");
        } elseif ($product_gewicht >= 1) {
            $gewicht_tekst .= ($product_gewicht . " kilo");
        } else {
            $gewicht_tekst .= ($product_gewicht . " gram");
        }
    }
    return $gewicht_tekst;
}

function getSize($StockItem)
{
    if ($StockItem["Size"] != NULL) {
        $product_grootte = $StockItem["Size"];
        //$product_specs .= ("Dit product is " . $product_grootte . "<br>");
    } else {
        $product_grootte = NULL;
    }
    return $product_grootte;
}

function getBrand($StockItem)
{
    if ($StockItem["Brand"] != NULL) {
        $product_merk = $StockItem["Brand"];
        //$product_specs .= ("Merk " . $product_merk . "<br>");
    } else {
        $product_merk = null;
    }
    return $product_merk;

}

function generateDiscountPercentage($StockItem)
{
    $StockItemID = $StockItem["StockItemID"];
    $SpecialDealStockItemID = array_column(getSpecialDealByStockItemID($StockItemID), "StockItemID");
    $DiscountPercentage = 0;
    if ($SpecialDealStockItemID != NULL) {
        if ($SpecialDealStockItemID[0] == $StockItemID) {
            $SpecialDealInfo = getSpecialDealByStockItemID($StockItemID);
            $DiscountPercentage = array_column($SpecialDealInfo, "DiscountPercentage");
            $DiscountPercentage = (int)$DiscountPercentage[0];
        }
    }
    return $DiscountPercentage;
}

function generateDiscountTextIfApplicable($StockItem)
{
    $DiscountPercentage = generateDiscountPercentage($StockItem);
    $product_discount_text = "";
    if ($DiscountPercentage != NULL && $DiscountPercentage != 0) {
        $product_discount_text .= ("" . $DiscountPercentage . "% korting!");
    }
    return $product_discount_text;
}

function generatePrice($StockItem)
{

    // Indien de voorgestelde prijs bekend is, verandert $product_prijs in de prijs. Indien deze niet bekend is pakt hij de vaste waarden binnen de UnitPrice en vermenigvuldigt hij deze met het TaxRate percentage.
    // Tevens checkt deze functie of het product in de aanbieding is en past dit toe.

    $DiscountPercentage = generateDiscountPercentage($StockItem);

    if ($StockItem["RecommendedRetailPrice"] != NULL) {
        if ($DiscountPercentage != NULL && $DiscountPercentage != 0) {
            $product_prijs = number_format($StockItem["RecommendedRetailPrice"] , 2);
        } else {
            $product_prijs = number_format($StockItem["RecommendedRetailPrice"], 2);
        }
    } elseif ($StockItem["RecommendedRetailPrice"] == NULL && $DiscountPercentage != (NULL || 0)) {
        $product_prijs = number_format(($StockItem["UnitPrice"] * $StockItem["TaxRate"] / 100 + 1) / 100 * (100 - $DiscountPercentage), 2);
    } else {
        $product_prijs = ("--,--" . "<br>");
    }

    return $product_prijs;
}

function generateDiscountPrice($StockItem)
{

    // Indien de voorgestelde prijs bekend is, verandert $product_prijs in de prijs. Indien deze niet bekend is pakt hij de vaste waarden binnen de UnitPrice en vermenigvuldigt hij deze met het TaxRate percentage.
    // Tevens checkt deze functie of het product in de aanbieding is en past dit toe.

    $DiscountPercentage = generateDiscountPercentage($StockItem);

    if ($StockItem["RecommendedRetailPrice"] != NULL) {
        if ($DiscountPercentage != NULL && $DiscountPercentage != 0) {
            $product_prijs = number_format(($StockItem["RecommendedRetailPrice"] / 100 * (100 - $DiscountPercentage)), 2);
        } else {
            $product_prijs = number_format($StockItem["RecommendedRetailPrice"], 2);
        }
    } elseif ($StockItem["RecommendedRetailPrice"] == NULL && $DiscountPercentage != (NULL || 0)) {
        $product_prijs = number_format(($StockItem["UnitPrice"] * $StockItem["TaxRate"] / 100 + 1) / 100 * (100 - $DiscountPercentage), 2);
    } else {
        $product_prijs = ("--,--" . "<br>");
    }

    return $product_prijs;
}

function generateStock($StockItem)
{
// Indien de voorraad meer dan 0 is, is er voorraad, verandert $product_voorraad naar de voorraad. Anders is deze NULL
    $Stock = getStockItemHoldingByID($StockItem["StockItemID"]);
    if ($Stock["QuantityOnHand"] > 0) {
        $product_voorraad = $Stock["QuantityOnHand"];
        //$product_voorraad = ("<b>voorraad: </b>" . $product_voorraad) . " eenheden " . "<br>";
    } else {
        $product_voorraad = NULL;
        $product_voorraad = ("Dit product is momenteel niet op voorraad");
    }

    return $product_voorraad;
}

function generatePhoto($StockItem)
{
    $StockGroups = getStockGroupIDsFromStockItemID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
    $SingleStockGroup = array_rand($StockGroups, 1);
    $product_afbeelding_path = getImageLinkFromStockGroupID($StockGroups[$SingleStockGroup]);

    return ($product_afbeelding_path);
}

function generateReviews($StockItem)
{

    $ReviewWaarde = getAverageReviewValue($StockItem);
    $product_review = (float)$ReviewWaarde;

    $product_review = round($product_review);
    $product_review = (int)$product_review;
    If ($product_review <= 0) {
        $product_review = 1;
    }
    if ($product_review >= 5) {
        $product_review = 5;
    }

    $product_review = getCurrentReviewValue($product_review);

    return $product_review;
}

function generateUserReview($ReviewWaarde)
{

    //$ReviewWaarde = 3;
    $ReviewWaarde = (int)$ReviewWaarde;

    If ($ReviewWaarde <= 0) {
        $ReviewWaarde = 1;
    }
    if ($ReviewWaarde >= 5) {
        $ReviewWaarde = 5;
    }

    return getCurrentReviewValue($ReviewWaarde);
}


function generateCombiDealCards($combiDeals)
{

    $html = "";

    $html .= "<div class='card-group'>";

    foreach ($combiDeals as $combiDeal) {

        //$category = array_rand(getStockGroupIDsFromStockItemID($combiDeal["StockItemID"]));
        $category = $combiDeal["StockGroupID"];

        $link = getImageLinkFromStockGroupID($category);

        $html .= "<div class='card'>";
        $html .= "<img class='card-img-top'
                        height='200px' width='300px'
                        src='" . $link . "'
                        alt='Afbeelding mist'>";
        $html .= "<div class='card-body'>";
        $html .= "<a href='product.php?productID=" . $combiDeal["StockItemID"] . "'>";
        $html .= "<h5 class='card-title'>" . $combiDeal["StockItemName"] . "</h5>";
        $html .= "</a>";
        $html .= "</div>";
        $html .= "</div>";
    }
    $html .= "</div>";

    return $html;
}

function generateCombiDeals($StockItem)
{

    //Haal alle categories van dit product op.
    $categories = getStockGroupIDsFromStockItemID($StockItem["StockItemID"]);

    //Kies een willekeurige categorie uit.
    $singleCategoryKey = array_rand($categories);

    $singleCategory = $categories[$singleCategoryKey];

    //Haal alle producten op van deze categorie.
    $categoryItems = getStockItemsByStockGroupID($singleCategory);

    //Haal 3 producten op uit deze categorie.
    $combiDealsID = array_rand($categoryItems, 3);

    $combiDeals = [];

    foreach ($combiDealsID as $combiDeal) {
        $combiDeals [] = $categoryItems[$combiDeal];
    }

    return $combiDeals;
}
