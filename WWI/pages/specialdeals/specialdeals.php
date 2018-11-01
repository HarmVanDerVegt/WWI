<!DOCTYPE html>

<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/stockItemController.php";

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card Title</h5>
                            <p class="card-text"><?php
                            
                            $SpecialDeal = getSpecialDealByID(rand(1, 5));
                            $StockItem = getStockItemBySpecialDealID($SpecialDeal["SpecialDealID"]);
            
                            if ($SpecialDeal == NULL || FALSE) {
                                    ?> <img src=media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                                } else {
                                    ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                                }
                                ?></p>
                            <a href="/product?productID=<?php $StockItem["StockItemID"] ?>" class="btn btn-primary">Link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
