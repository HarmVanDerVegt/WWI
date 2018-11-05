<?php
session_start();

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");



$products = array("product A", "product B", "product C");
$amounts = array("19.99", "10.99", "2.99");
$check = 0;

#verwijderen
if (isset($_GET["delete"])) {
    $i = $_GET["delete"];
    $qty = $_SESSION["qty"][$i];
    $qty = $qty - 1;
    $_SESSION["qty"][$i] = $qty;
    //remove item if quantity is zero
    if ($qty == 0) {
        $_SESSION["amounts"][$i] = 0;
        unset($_SESSION["cart"][$i]);
    } else {
        $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
    }
}

#reset
if (isset($_GET['reset'])) {
    if ($_GET["reset"] == 'true') {
        unset($_SESSION["qty"]); //The quantity for each product
        unset($_SESSION["amounts"]); //The amount from each product
        unset($_SESSION["total"]); //The total cost
        unset($_SESSION["cart"]); //Which item has been chosen
    }
}

#winkelwagen
if (isset($_SESSION["cart"])) {
    $check = 1;
    ?>
    <h2>Winkelwagen</h2>
    <table class="table">
        <tr class="table-primary">
            <th>Product</th>
            <th width="10px">&nbsp;</th>
            <th>Qty</th>
            <th width="10px">&nbsp;</th>
            <th>Amount</th>
            <th width="10px">&nbsp;</th>
            <th>Action</th>
        </tr>
    <?php
    $total = 0;
    foreach ($_SESSION["cart"] as $i) {
        ?>
            <tr>
                <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>
                <td width="10px">&nbsp;</td>
                <td><?php echo( $_SESSION["qty"][$i] ); ?></td>
                <td width="10px">&nbsp;</td>
                <td><?php echo( $_SESSION["amounts"][$i] ); ?></td>
                <td width="10px">&nbsp;</td>
                <td><a href="?delete=<?php echo($i); ?>">Delete from cart</a></td>
            </tr>
        <?php
        $total = $total + $_SESSION["amounts"][$i];
    }
    $_SESSION["total"] = $total;
    ?>
        <tr>
            <td colspan="7">Total : <?php echo($total); ?></td>
        </tr>
        <tr>
            <td colspan="7"><a href="?reset=true">Reset Cart</a></td>
        </tr>
    </table>
    <?php
}
?>
    
<?php
if ($check == 0){
    print("<h3>Uw winkelwagen is leeg!</h3><br>");
}else{
?>
<?php } ?>
