<!DOCTYPE html>

<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="\WWI\WWI\css\bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <title>Wide  World Importers</title>
        <!-- eigen opmaak regels -->
        <style>
            img.specialdeals{
                max-height: 300px;
                width: 1135px;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            h2.center{
                text-align: center;
                color: white;
            }
            div.blue_titel{
                margin-left: 30px;
                margin-right: 30px;
                margin-bottom: 10px;
                padding-bottom: 5px;
                padding-top: 5px;
                background-color: #00BCF3;
                border-radius: 15px;
            }
        </style>
    </head>
    <body>
        <!-- voegt header toe -->
        <?php include(ROOT_PATH . "/includes/header.php"); ?>
        <br>

        <!-- ophalen gegevens van special deals uit database -->
        <?php
        include_once ROOT_PATH . "/controllers/stockItemController.php";
        include_once ROOT_PATH . "/controllers/specialDealsController.php";
        $LowestSpecialDealValue = getLowestSpecialDealID();
        $HighestSpecialDealValue = getHighestSpecialDealID();

        $SpecialDeal = getSpecialDealByID(rand($LowestSpecialDealValue, $HighestSpecialDealValue));
        $StockItem = $SpecialDeal['StockItemID']; //getStockItemBySpecialDealID($SpecialDeal["StockItemID"]);
        $afbeelding_specialdeal = "./media/SpecialDeals/SpecialDealFotoNietBeschikbaar.png";
        ?>

<!--        <div class='blue_titel'><h2 class="center">Aanbiedingen:</h2></div>-->
        <a href="../pages/category/product.php?productID=<?php print($StockItem); ?>">
            <img                       
                class="specialdeals"
                src="<?php print($afbeelding_specialdeal); ?>"
                >
        </a>
        <!-- eind specialdeals |-->

        <br>
        <br>

        <!-- begin categorie knoppen------------------------------------------------------------------------------ -->
<!--        <!-- titel -->
<!--        <div class='blue_titel'><h2 class="center">category's:</h2></div>-->
        <!-- category informatie ophalen -->
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
