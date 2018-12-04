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

$debug = 0;
?>
<?php
include_once(ROOT_PATH . "/includes/header.php");

if (!defined('ROOT_PATH')) {
    include("../config.php");
}
if (($_SESSION['IsSystemUser']) <> 1) {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=/WWI/WWI/pages/index.php\" />";
}
$customerdata = getCustomerByID($_SESSION['USID']);
$Cityname = getCityByID($customerdata['DeliveryCityID']);

if ($debug == 1) {
    echo $_SESSION['IsEmployee'] . "IsEmployee <BR>";
    echo $_SESSION['IsSystemUser'] . "IsSystemUser <BR>";
    echo $_SESSION['PreferredName'] . "PreferredName <BR>";
    echo $_SESSION['FullName'] . "FullName <BR>";
    echo $_SESSION['LogonName'] . "LogonName <BR>";
    echo $_SESSION['USID'] . "LogonName <BR>";
    print_r($_SESSION . '<br>');
    print_r($customerdata);
}






echo '<BR>';
?>
<div class="py-5">
    <div class="container">
        <div class="row hidden-md-up">
            <div class="col-md-12">
                <div class="card-custom"">
                    <div class="card-block">
                        <h4 class="card-custom-title text-light">Bestellingen</h4>
                            <?php
                        function getBestellingByPurchaseorderID($ID)
                        {
                        return getRowByIntID("PurchaseorderID", "purchaseorders", $ID);
                        }

                        function getProductsByPurchaseorderID($ID)
                        {

                        return getQuantityByPurchaseOrderID($ID, "purchaseorders", "purchaseorderlines", "PurchaseOrderID", "PurchaseOrderID");
                        }


                        $array = getBestellingByPurchaseorderID(1);
                        $productenarray = getProductsByPurchaseorderID(1);
                        $totaal = 0;

                        ?>

                        <div class="mx-auto" style="width: 36rem;">
                            <p>Bestelling nummer: <?php print($array['PurchaseOrderID'] . " van " . $array['OrderDate']); ?></p><br>


                            <?php
                            $vandaag = date("Y/m/d");
                            $morgen = date("Y/m/d", time() + 86400);
                            if ($vandaag > $array['ExpectedDeliveryDate']) {
                            ?>
                            <i class="fa fa-cubes" style="font-size:50px;color: orange"></i>
                            <i class="fa fa-arrow-right" style="font-size:50px;color: orange"></i>
                            <i class="material-icons" style="font-size:60px;color: orange">local_shipping</i>
                            <i class="fa fa-arrow-right" style="font-size:50px;color: orange"></i>
                            <i class="fa fa-home" style="font-size:60px;color: orange"></i><br>
                            <p>Uw bestelling is bezorgd!</p><br>
                            <p>De verwachte bezorgdatum was:
                                <?php
                                print("<b>" . $array['ExpectedDeliveryDate'] . "</b></p><br>");
                                ?>

                                <?php } elseif ($morgen == $array['ExpectedDeliveryDate']) {
                                ?>
                                <i class="fa fa-cubes" style="font-size:50px;color: aqua"></i>
                                <i class="fa fa-arrow-right" style="font-size:50px;color: aqua"></i>
                                <i class="material-icons" style="font-size:60px;color: aqua">local_shipping</i>
                                <i class="fa fa-arrow-right" style="font-size:50px"></i>
                                <i class="fa fa-home" style="font-size:60px"></i><br>
                            <p>Uw bestelling is onderweg!</p><br>
                            <p>De verwachte bezorgdatum is:
                                <?php
                                print("<b>" . $array['ExpectedDeliveryDate'] . "</b></p><br>");
                                } else { ?>
                                <i class="fa fa-cubes" style="font-size:50px;color: aqua"></i>
                                <i class="fa fa-arrow-right" style="font-size:50px"></i>
                                <i class="material-icons" style="font-size:60px">local_shipping</i>
                                <i class="fa fa-arrow-right" style="font-size:50px"></i>
                                <i class="fa fa-home" style="font-size:60px"></i><br>
                            <p>Uw bestelling is nog in behandeling!</p><br>
                            <p>De verwachte bezorgdatum is:
                                <?php
                                print("<b>" . $array['ExpectedDeliveryDate'] . "</b></p><br>");
                                } ?>
                        </div>

                        <div class="mx-auto" style="width: 50rem;">

                            <table class="table-striped table-sm">
                                <tr class="table-primary">
                                    <th>Product</th>
                                    <th width="10px">&nbsp;</th>
                                    <th>Productprijs</th>
                                    <th width="10px"></th>
                                    <th>Hoeveelheid</th>
                                    <th width="10px">&nbsp;</th>
                                    <th>Subtotaal</th>
                                </tr>

                                <?php
                                foreach ($productenarray as $product) {

                                    $productprijs = $product['ExpectedUnitPricePerOuter'];
                                    $productprijs = number_format($productprijs, 2);
                                    $hoeveelheid = $product['Quantity'];
                                    $subtotaal = number_format($productprijs * $hoeveelheid, 2);
                                    ?>

                                    <tr>
                                        <td><?php print(getStockItemByID($product["StockItemID"])["StockItemName"]); ?></td>
                                        <td width="10px">&nbsp;</td>
                                        <td><?php print("€" . $productprijs); ?></td>
                                        <td width="10px"></td>
                                        <td><?php print($hoeveelheid); ?></td>
                                        <td width="10px">&nbsp;</td>
                                        <!--prijs weergeven-->
                                        <td><?php echo("€" . $subtotaal); ?></td>
                                        <td width="10px">&nbsp;</td>
                                    </tr>
                                    <?php
                                    //            totaalprijs weergeven
                                    $totaal += $subtotaal;
                                }
                                ?>
                                <tr>
                                    <td colspan="7">Totaal : €<?php echo(number_format($totaal, 2)); ?></td>
                                </tr>
                            </table>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row hidden-md-up">
            <div class="col-md-12">
                <div class="card-custom"">
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