<?php
if (!defined('ROOT_PATH')) {
    include("../../config.php");
}

// Hier worden de verschillende controllers ingevoegd.
include_once ROOT_PATH . "/includes/header.php";
include_once ROOT_PATH . "/controllers/productController.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/photoController.php";
include_once ROOT_PATH . "/controllers/reviewController.php";
include_once ROOT_PATH . "/controllers/rpiTempController.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Category</title>
</head>
<body>
<?php
// Haalt productwaardes op
$StockItem = getStockItemByID(filter_input(INPUT_GET, "productID", FILTER_VALIDATE_INT));
$Stock = getStockItemHoldingByID($StockItem["StockItemID"])["QuantityOnHand"];
$CombiDeals = generateCombiDeals($StockItem);

// Controleert de reviewwaarde en insert deze zo nodig in de database
if (isset($_POST["ster"])) {
    $reviewwaarde = filter_input(INPUT_POST, "ster", FILTER_VALIDATE_INT);
    $reviewwaarde = (int)$reviewwaarde;
    if ($reviewwaarde >= 1 && $reviewwaarde <= 5) {
        if (isset($_SESSION["USID"]) and $_SESSION["IsEmployee"] == 0) {
            insertReviewValue($_SESSION["USID"], $StockItem["StockItemID"], $reviewwaarde);
        }
    } else {
        echo '<META HTTP-EQUIV="refresh" content="=0;URL=../error.php">';
    }
}
?>

<div class="container">
    <h4><?php print $StockItem["StockItemName"] ?></h4>
    <div class="row">
        <div class="col-6 offset-6" style="padding-bottom: 10px">
            <div style="padding-bottom: 10px">
                <?php
                // Controleert of er al een eerder review door deze gebruiker is gegeven en past hierop aan
                $addendum = "(" . number_format(getAverageReviewValue($StockItem["StockItemID"]), 1) . "), " . getReviewCountByStockItemID($StockItem) . " reviews";
                if (isset($_SESSION["USID"])) {
                    $reviewValue = getUserSpecificReviewByStockItemID($_SESSION["USID"], $StockItem["StockItemID"]);
                    if ($reviewValue != null) {
                        print generateUserReview($reviewValue) . $addendum;
                    } else {
                        print generateReviews($StockItem["StockItemID"]) . $addendum;
                    }
                } else {
                    print generateReviews($StockItem["StockItemID"]) . $addendum;
                };
                ?>
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
                    <?php
                    // Berekent en toont een korting als deze toepasselijk is
                    if (generateDiscountPercentage($StockItem) != null) {
                        print "<b>Prijs:</b><strike> €" . number_format(generatePrice($StockItem), 2) . "</strike><br>";
                        echo generateDiscountTextIfApplicable($StockItem) . "<br>";
                        print "<b>Nieuwe Prijs:</b> €" . number_format(generateDiscountPrice($StockItem), 2);
                    }
                    ?>
                    <?php
                    // Berekent de prijs als er geen korting toepasselijk is
                    if (generateDiscountPercentage($StockItem) == null) {
                        print "<b>Prijs:</b> €" . number_format(generatePrice($StockItem), 2);
                    }
                    ?>

                    <br>
                    <?php print "<b>Voorraad:</b> " . generateStock($StockItem) ; ?>
                    <br>
                    <form method="post" action="/WWI/WWI/pages/ShoppingCart.php">
                        <input type="hidden" value="<?php echo($StockItem["StockItemID"]); ?>" name="add">
                        <label for="hoeveelheid">Aantal:
                            <input type="number" name="hoeveelheid" min="1" max="<?php print $Stock ?>" value="0"
                                   required>
                        </label>
                        <br>
                        <input type="submit" class="btn btn-sample btn-sample-success"
                               value="Toevoegen aan winkelwagen">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <?php 
            // Haalt alle toepasselijke productinformatie op
            print generateProductPageInformation($StockItem); ?>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="bg-light card">
            <h4>Combideals:</h4>
            <p> Misschien zijn deze producten een leuke combinatie met dit product? </p>
            <?php
            // Geneert de combideals
            
            echo generateCombiDealCards($CombiDeals); ?>
        </div>
    </div>
</div>
<br>
</body>

<?php include_once ROOT_PATH . "/includes/footer.php"; ?>
</html>
