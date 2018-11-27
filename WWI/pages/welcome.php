<?php
/**
 * Created by PhpStorm.
 * User: lexkruiper97
 * Date: 21-11-2018
 * Time: 11:07
 */
?>
    <link href="\WWI\WWI\css\card.css" rel="stylesheet" type="text/css"/>
<?php
if (!defined('ROOT_PATH')) {
    include_once("../config.php");
}

include_once ROOT_PATH . "/controllers/databaseController.php";

$debug =0;
?>
<?php include_once(ROOT_PATH . "/includes/header.php");

if (!defined('ROOT_PATH')) {
    include("../config.php");
}
if (($_SESSION['IsSystemUser']) <> 1 ){
    echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost:63342/WWI/WWI/pages/index.php\" />";
}
if ($debug == 1) {
    echo $_SESSION['IsEmployee'] . "IsEmployee <BR>";
    echo $_SESSION['IsSystemUser'] . "IsSystemUser <BR>";
    echo $_SESSION['PreferredName'] . "PreferredName <BR>";
    echo $_SESSION['FullName'] . "FullName <BR>";
    echo $_SESSION['LogonName'] . "LogonName <BR>";
    echo $_SESSION['USID'] . "LogonName <BR>";

}


$customerdata = getCustomerByID($_SESSION['USID']);
    foreach ($customerdata as $arresult) {
        $customers = $arresult;

    }


print_r( $customers);
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
            <div class="col-md-6">
                <div class="card-custom"">
                    <div class="card-block">
                        <h4 class="card-custom-title text-light">Gegevens</h4>
                        <!-- klant gegevens -->
                        <?php
                        echo "<a class=\"text-light\"> Volledige Naam: ".$_SESSION['FullName'] . "</a> <BR>";
                        echo "<a class=\"text-light\"> Email: ".$_SESSION['LogonName'] . " </a> <BR>";
                        echo "<a class=\"text-light\"> Volledige Naam: ".$_SESSION['FullName'] . "</a> <BR>";
                        echo "<a class=\"text-light\"> Email: ".$_SESSION['LogonName'] . " </a> <BR>";
                        echo "<a class=\"text-light\"> Volledige Naam: ".$_SESSION['FullName'] . "</a> <BR>";
                        echo "<a class=\"text-light\"> Email: ".$_SESSION['LogonName'] . " </a> <BR>";




                        ?>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card-custom"">
                    <div class="card-block">
                        <h4 class="card-custom-title text-light">Wijzigen</h4>
                        <!-- wijzigen klant gegevens -->


                    </div>
                </div>
            </div>
        </div><br>


        </div>
    </div>
</div>





























<?php include_once(ROOT_PATH . "/includes/footer.php"); ?>