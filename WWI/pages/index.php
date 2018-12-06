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
<body>
    <!-- voegt header toe -->

    <br>

    <!-- ophalen gegevens van special deals uit database -->
    <?php
    $LowestSpecialDealValue = getLowestSpecialDealID();
    $HighestSpecialDealValue = getHighestSpecialDealID();

    $SpecialDeal = getAllSpecialDeals();
    $SpecialDeal = array_column($SpecialDeal, "StockItemID");
    ?>

    <div class="py-5">
        <div class="container">

            <?php
            foreach ($SpecialDeal as $Deal) {
                $StockItem = $Deal;
                ?>
                <div class="py-5">
                    <div class="container">
                        <div class="row hidden-md-up">
                            <div class="col-md-12">
                                <div class="card-custom">
                                    <div class="card-block">
                                        <a href="../pages/category/product.php?productID=<?php print($StockItem); ?>" class="card-link"><?php show_afbeelding(laad_afbeelding($StockItem), 300, 1135); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                    </div>
                </div>
    <?php
}
?>

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
