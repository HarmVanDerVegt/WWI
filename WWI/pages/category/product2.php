<?php
if (!defined('ROOT_PATH')) {
    include("../../config.php");
}

// Hier worden de verschillende controllers ingevoegd.
include_once ROOT_PATH . "/includes/header.php";
include_once ROOT_PATH . "/controllers/productController2.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/photoController.php";
include_once ROOT_PATH . "/controllers/reviewController.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <title>Category</title>
</head>
<body>
<?php
$StockItem = getStockItemByID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
$Stock = getStockItemHoldingByID($StockItem["StockItemID"])["QuantityOnHand"];
$CombiDeals = generateCombiDeals($StockItem);

?>

<div class="container">
    <h4><?php print $StockItem["StockItemName"] ?></h4>
    <div class="row">
        <div class="col-6 offset-6" style="padding-bottom: 10px">
            <div style="padding-bottom: 10px">
            <?php if (isset($_SESSION["USID"])){
                if (getUserSpecificReviewByStockItemID($_SESSION["USID"], $StockItem["StockItemID"]) != null){
                    print generateUserReview(getUserSpecificReviewByStockItemID($_SESSION["USID"], $StockItem["StockItemID"])["Waarde"]);
                } else{
                    print generateReviews($StockItem["StockItemID"]) . "(" . number_format(getAverageReviewValue($StockItem["StockItemID"]), 1) . ")";
                }
            } else {
                print generateReviews($StockItem["StockItemID"]) . "(" . number_format(getAverageReviewValue($StockItem["StockItemID"]), 1) . ")";
            }; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php show_afbeelding(laad_afbeelding($StockItem["StockItemID"]), 350, 350); ?>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col" style="padding-bottom: 10px">
                    <?php print "<b>Prijs:</b> €" . number_format(generatePrice($StockItem), 2); ?>
                    <br>
                    <?php print "<b>Voorraad:</b> " . generateStock($StockItem) . " eenheden"; ?>
                    <br>
                    <form method="post" action="/WWI/WWI/pages/ShoppingCart.php">
                        <input type="hidden" value="<?php echo($StockItem["StockItemID"]); ?>" name="add">
                        <label for="hoeveelheid">Aantal:
                            <input type="number" name="hoeveelheid" min="1" max="<?php print $Stock ?>" value="0" required>
                        </label>
                        <br>
                        <input type="submit"  class="btn btn-sample btn-sample-success" value="Toevoegen aan winkelwagen">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <?php print generateProductPageInformation($StockItem); ?>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="bg-light card">
            <h4>Combideals:</h4>
            <p> Misschien zijn deze producten een leuke combinatie met dit product? </p>
            <?php echo generateCombiDealCards($CombiDeals); ?>
        </div>
    </div>
</div>
<br>
</body>

<?php include_once ROOT_PATH . "/includes/footer.php"; ?>
</html>
