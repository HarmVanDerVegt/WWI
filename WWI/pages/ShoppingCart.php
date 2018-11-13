<?php
session_start();

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

//include(ROOT_PATH . "/includes/header.php");



$products = array("product A", "product B", "product C");
$amounts = array("19.99", "10.99", "2.99");
$check = 0;

#Product toevoegen
 if ( isset($_GET["add"]) )
   {
   $i = $_GET["add"];
   $qty = $_GET["hoeveelheid"];
   $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
   $_SESSION["cart"][$i] = $i;
   $_SESSION["qty"][$i] = $qty;
 }

#verwijderen
if (isset($_GET["delete"])) {
    $i = $_GET["delete"];
   $qty = $_SESSION["qty"][$i];
    $qty = $qty - 1;
    $_SESSION["qty"][$i] = $qty;

   if ($qty <= 0) {
       $_SESSION["amounts"][$i] = 0;
       unset($_SESSION["cart"][$i]);
    } else {
        $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
    }
}

#reset
if (isset($_GET['reset'])) {
    if ($_GET["reset"] == 'true') {
        unset($_SESSION["qty"]);
        unset($_SESSION["amounts"]);
        unset($_SESSION["total"]);
        unset($_SESSION["cart"]);
    }
}

#winkelwagen
if (isset($_SESSION["cart"])) {
    $check = 1;
    ?>
    <h2>Winkelwagen</h2>
    <table>
        <tr>
            <th>Product</th>
            <th width="10px">&nbsp;</th>
            <th>Hoeveelheid</th>
            <th width="10px">&nbsp;</th>
            <th>Prijs</th>
            <th width="10px">&nbsp;</th>
            <th>Verwijderen</th>
        </tr>
        <?php
        $total = 0;
        foreach ($_SESSION["cart"] as $i) {
            ?>
        <form action="ShoppingCart.php">
            <input type="hidden" value="<?php echo($i)?>" name="add">
            <tr>
                <td><?php print( $products[$i]); ?></td>
                <td width="10px">&nbsp;</td>
                <td><input type="number" name="hoeveelheid" min="0" value="<?php echo( $_SESSION["qty"][$i] ); ?>"></td>
                <td width="10px">&nbsp;</td>
                <td><?php echo( $_SESSION["amounts"][$i] ); ?></td>
                <td width="10px">&nbsp;</td>
                <td><input type="submit" value="Update winkelwagen"></td>
            </tr>
        </form>
            <?php
            $total = $total + $_SESSION["amounts"][$i];
        }
        $_SESSION["total"] = $total;
        ?>
        <tr>
            <td colspan="7">Totaal : <?php echo($total); ?></td>
        </tr>
    </table>
    <?php
}
?>

<?php
if ($check == 0) {
    print("<h3>Uw winkelwagen is leeg!</h3><br>");
} else {
    ?>
    <tr>
        <td colspan="5"></td>
    </tr>
    <tr>
        <td colspan="5"><a href="?reset=true">Reset winkelwagen</a></td>
    </tr>
<?php } ?>