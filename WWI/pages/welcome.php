<?php
/**
 * Created by PhpStorm.
 * User: lexkruiper97
 * Date: 21-11-2018
 * Time: 11:07
 */

if (!defined('ROOT_PATH')) {
    include_once("../config.php");
}

include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/specialDealsController.php";

?>

<?php include_once(ROOT_PATH . "/includes/header.php");

if (!defined('ROOT_PATH')) {
    include("../config.php");
}
if (($_SESSION['IsSystemUser']) <> 1 ){
    echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost:63342/WWI/WWI/pages/index.php\" />";
}

echo $_SESSION['IsEmployee']."IsEmployee <BR>";
echo $_SESSION['IsSystemUser']."IsSystemUser <BR>";
echo $_SESSION['PreferredName']."PreferredName <BR>";
echo $_SESSION['FullName']."FullName <BR>";
echo $_SESSION['LogonName']."LogonName <BR>";



include_once(ROOT_PATH . "/includes/footer.php"); ?>