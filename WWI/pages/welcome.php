<link href="\WWI\WWI\css\card.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" xmlns:>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<?php
if (!defined('ROOT_PATH')) {
    include_once("../config.php");
}

include_once ROOT_PATH . "/controllers/databaseController.php";
include_once ROOT_PATH . "/controllers/userController.php";
include_once ROOT_PATH . "/controllers/stockItemController.php";


?>
<?php
include_once(ROOT_PATH . "/includes/header.php");


if (($_SESSION['IsSystemUser']) <> 1) {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=/WWI/WWI/pages/index.php\" />";
}
$customerdata = getCustomerByID($_SESSION['USID']);
$Cityname = getCityByID($customerdata['DeliveryCityID']);


echo '<BR>';
?>
<div class="py-5">
    <div class="container">
        <div class="row hidden-md-up">
            <div class="col-md-12">
                <div class="card-custom"
                ">
                <div class="card-block">
                    <h4 class="card-custom-title text-light">Bestellingen</h4>
                    <?php
                    $PersonID = $_SESSION["USID"];
                    $Orders = getOrderByPersonID($PersonID);

                    if (empty($Orders)) {
                        print "<p>Er zijn geen bestellingen beschikbaar</p>";
                    } else {
                    foreach ($Orders

                    as $order) {
                    ?>
                    <?php
                    $array = getBestellingByPurchaseorderID($order);
                    print "<div class=\"card\">";
                    print "Bestelling : <b>" . $order . "</b><br>";
                    print "Besteld op : " . $array['OrderDate'] . "<br>";
                    print "prijs : €" . $_SESSION["totaal"] . "<br>";
                    ?>
                    <form action="BestelStatus.php">
                        <input type="hidden" value="<?php print $order; ?>" name="OrderID" "
                        <input type="submit" class="btn btn-sample" value="Selecteren">
                    </form>
                </div>
                <?php }
                } ?>
            </div>
            <br>
        </div>
    </div>
</div>
</div><br>
<div class="row hidden-md-up">
    <div class="col-md-12">
        <div class="card-custom"
        ">
        <div class="card-block">
            <h4 class="card-custom-title text-light">Gegevens</h4>
            <!-- klant gegevens -->
            <?php
            echo "<body class=\"text-light\"> Volledige Naam: " . $_SESSION['FullName'] . "</body> <BR>";
            echo "<body class=\"text-light\"> Email: " . $_SESSION['LogonName'] . " </body> <BR>";
            echo "<body class=\"text-light\"> Straat: " . $customerdata['DeliveryAddressLine1'] . " </body> <BR>";
            echo "<body class=\"text-light\"> Postcode: " . $customerdata['DeliveryPostalCode'] . " </body> <BR>";
            echo "<body class=\"text-light\"> Woonplaats: " . $Cityname['CityName'] . " </body> <BR>";
            ?>
        </div>
    </div>
</div>


</div>
</div>
</div>


<?php include_once(ROOT_PATH . "/includes/footer.php"); ?>