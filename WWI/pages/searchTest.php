<?php
include_once "../controllers/stockItemController.php";

//foreach (getSearchTags() as $tag){
//////    print $tag . "<br>";
//////}

$tags = ["USB Powered", "32GB"];

//print_r(getStockItemsByTags($tags));

foreach (getStockItemsByTags($tags) as $stockItem){
    print $stockItem["StockItemName"] . "<br>";
}