<?php

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");

$products = array("product A", "product B", "product C");
$amounts = array("19.99", "10.99", "2.99");

#sessie laden
if (!isset($_SESSION["total"])) {
    $_SESSION["total"] = 0;
    for ($i = 0; $i < count($products); $i++) {
        $_SESSION["qty"][$i] = 0;
        $_SESSION["amounts"][$i] = 0;
    }
}
?>

<h2>Producten</h2>
<table>
    <tr>
        <th>Product</th>
        <th width="10px">&nbsp;</th>
        <th>Prijs</th>
        <th width="10px">&nbsp;</th>
        <th>Hoeveelheid</th>
        <th width="10px">&nbsp;</th>
        <th>Toevoegen aan winkelwagen</th>
    </tr>


    <?php
    for ($i = 0; $i < count($products); $i++) {
        ?>
        <form action="ShoppingCart.php">
            <input type="hidden" value="<?php echo($i)?>" name="add">
            <tr>
                <td><?php echo($products[$i]); ?></td>
                <td width="10px">&nbsp;</td>
                <td><?php echo($amounts[$i]); ?></td>
                <td width="10px">&nbsp;</td>
                <td><input type="number" name="hoeveelheid" min="0"></td>
                <td width="10px">&nbsp;</td>
                <td><input type="submit" value="Toevoegen aan winkelwagen"></td>
            </tr>
        </form>
        <?php
    }

 //include(ROOT_PATH . "/includes/footer.php"); ?>
