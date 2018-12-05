<!DOCTYPE html>

<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/specialDealsController.php";
include_once ROOT_PATH . "/controllers/photoController.php";

?>

<?php include_once(ROOT_PATH . "/includes/header.php"); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide  World Importers</title>
        <!-- eigen opmaak regels -->


        </div>
    </head>
    <body>
        <!-- voegt header toe -->
        
        <br>

        <!-- ophalen gegevens van special deals uit database -->
        <?php
        $LowestSpecialDealValue = getLowestSpecialDealID();
        $HighestSpecialDealValue = getHighestSpecialDealID();

        $SpecialDeal = getSpecialDealByID(rand($LowestSpecialDealValue, $HighestSpecialDealValue));
        $StockItem = $SpecialDeal['StockItemID']; //getStockItemBySpecialDealID($SpecialDeal["StockItemID"]);
        $a=laad_afbeelding($StockItem);
        $afbeelding_specialdeal = "data:image/jpeg;base64,".array_pop($a);
        // $afbeelding_specialdeal = "./media/SpecialDeals/SpecialDealFotoNietBeschikbaar.png";
        ?>
        <div class="py-5">
            <div class="container">
                <div class="row hidden-md-up">
                    <div class="col-md-12">
                        <div class="card-custom">
                            <div class="card-block">
                                <a href="../pages/category/product.php?productID=<?php print($StockItem); ?>" class="card-link"><img class="card-img-top" src="<?php print($afbeelding_specialdeal); ?>"  alt="Card image cap" style="max-width:1135px;max-height:300px;" ></a>
                            </div>
                        </div>
                    </div>
                </div><br>

            </div>
        </div>


        <br>
        <br>


        <?php

        // speciale data type voor category informatie
        class category_type {

            public $category = "";
            public $foto_path = "";
            public $link = "";

        }

        // laad category data
        include('data/category_data.php');
        ?>
        <!-- laat de product categoryen zien -->
        <?php
        // variablen
        $height = 100;
        $width = 100;
        // genereer html code die de category's laat zien
        print('<div class="container">');
        print('<div class="row">');
        ?>
        <!-- Rest van de categorieën -->
        <?php
        foreach ($category as $item) {
            // toon kaart met naam en foto van category
            print('<div class="col-6 col-sm-4" >');
            print('<div class="card">');
            print('<a href="' . $item->link . '" class="btn btn-sample btn-sample-success" role="button">');
            print('<strong>' . $item->category . '</strong><br>');
            print('<img src="' . $item->foto_path . '" alt="' . $item->category . '" height="' . $height . 'px" width="' . $width . 'px">');
            print('</a>');
            print('</div>');
            print('</div>');
        }
        print('</div>');
        print('</div>');
        ?>
        <!-- einde category knoppen------------------------------------------------------------------------------ -->
        <!-- voeg footer toe -->
        <br>
        <?php include(ROOT_PATH . "/includes/footer.php"); ?>
    </body>
</html>
