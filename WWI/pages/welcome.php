<link href="\WWI\WWI\css\card.css" rel="stylesheet" type="text/css"/>
<?php
if (!defined('ROOT_PATH')) {
    include_once("../config.php");
}

include_once ROOT_PATH . "/controllers/databaseController.php";
include_once ROOT_PATH . "/controllers/userController.php";

$debug = 0;
?>
<?php
include_once(ROOT_PATH . "/includes/header.php");

if (!defined('ROOT_PATH')) {
    include("../config.php");
}
if (($_SESSION['IsSystemUser']) <> 1) {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost:63342/WWI/WWI/pages/index.php\" />";
}
$customerdata = getCustomerByID($_SESSION['USID']);
$Cityname = getCityByID($customerdata['DeliveryCityID']);
print_r($Cityname);
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
                        <!-- order data -->


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


            <!--            <div class="col-md-6">-->
            <!--                <div class="card-custom"">-->
            <!--                    <div class="card-block">-->
            <!--                        <h4 class="card-custom-title text-light">Wijzigen</h4>-->
            <!--                        <!-- wijzigen klant gegevens -->
            <!---->
            <!---->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div><br>-->


        </div>
    </div>
</div>





























<?php include_once(ROOT_PATH . "/includes/footer.php"); ?>