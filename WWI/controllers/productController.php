<?php

include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/stockGroupsController.php";

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