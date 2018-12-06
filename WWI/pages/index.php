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
    <br>
    <!-- ophalen gegevens van special deals uit database -->
    <?php
    $LowestSpecialDealValue = getLowestSpecialDealID();
    $HighestSpecialDealValue = getHighestSpecialDealID();

    $SpecialDeal = getSpecialDealByID(rand($LowestSpecialDealValue, $HighestSpecialDealValue));
    $StockItem = $SpecialDeal['StockItemID'];

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
            </div>
            <br>
        </div>
    </div>
    <br>
    <br>
    <?php
    // genereer html code die de category's laat zien
    print('<div class="container">');
    print('<div class="row">');
    foreach (getAllStockGroups() as $category){
        // toon kaart met naam en foto van category
        print('<div class="col-6 col-sm-4">');
        print('<div class="card">');
        print('<a href="' . getStockGroupLink($category) . '" class="btn btn-sample btn-sample-success" role="button">');
        print('<strong>' . $category["StockGroupName"] . '</strong><br>');
        print('<img src="' . getImageLinkFromStockGroupID2($category["StockGroupID"]) . '" height=100px" width="100px">');
        print('</a>');
        print('</div>');
        print('</div>');
    }
    print('</div>');
    print('</div>');
    ?>
    <br>
    <?php include(ROOT_PATH . "/includes/footer.php"); ?>
</body>
