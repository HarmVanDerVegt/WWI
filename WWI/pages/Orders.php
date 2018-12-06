<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
include_once ROOT_PATH . "/controllers/databaseController.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/OrderController.php";


// voegt header toe
include(ROOT_PATH . "/includes/header.php");

$PersonID = $_SESSION["USID"];
$Orders = getOrderByPersonID($PersonID);

foreach ($Orders

as $order){
?>
<div class="card">
    <?php
    $array = getBestellingByPurchaseorderID($order);
    print "Bestelling : <b>" . $order . "</b><br>";
    print "Besteld op : " . $array['OrderDate'] . "<br>";
    print "prijs : €" . $_SESSION["totaal"] . "<br>";
    ?>
    <form action="BestelStatus.php">
        <input type="hidden" value="<?php print $order; ?>" name="OrderID" "
        <input type="submit" class="btn btn-sample" value="Selecteren">
    </form>
</div>
<?php } ?>