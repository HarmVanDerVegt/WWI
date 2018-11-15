<?php

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");



$products = array("product A", "product B", "product C");
$amounts = array("19.99", "10.99", "2.99");
$check = 0;

#Product toevoegen
if (NULL != (filter_input(INPUT_GET, "add", FILTER_SANITIZE_STRING))) {
    $i = filter_input(INPUT_GET, "add", FILTER_SANITIZE_STRING);
    $qty = filter_input(INPUT_GET, "hoeveelheid", FILTER_SANITIZE_STRING);
    $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
    $_SESSION["cart"][$i] = $i;
    $_SESSION["qty"][$i] = $qty;
}

#verwijderen
if (NULL !=(filter_input(INPUT_GET, "delete", FILTER_SANITIZE_STRING))) {
    $i = filter_input(INPUT_GET, "delete", FILTER_SANITIZE_STRING);
    $qty = $_SESSION["qty"][$i];
    $_SESSION["qty"][$i] = $qty;
    $_SESSION["amounts"][$i] = 0;
    unset($_SESSION["cart"][$i]);
}


#reset
if (NULL != filter_input(INPUT_GET, "reset", FILTER_SANITIZE_STRING)) {
    if (filter_input(INPUT_GET, "reset", FILTER_SANITIZE_STRING) == 'true') {
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
            <th>Updaten</th>
            <th width="10px">&nbsp;</th>
            <th>Verwijderen</th>
        </tr>
        <?php
        $total = 0;
        foreach ($_SESSION["cart"] as $i) {
            ?>
            <form action="ShoppingCart.php">
                <input type="hidden" value="<?php echo($i) ?>" name="add">
                <tr>
                    <td><?php print($products[$i]); ?></td>
                    <td width="10px">&nbsp;</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" value="<?php echo($_SESSION["qty"][$i]); ?>" id="hoeveelheid" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                hoeveelheid
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php for($a = 1; $a <= 10; $a++){
                                    print("<a class=\"dropdown-item\" href=\"#\">" . $a . "</a>") ;} ?>
                            </div>
                        </div>
                    </td>
                    <td width="10px">&nbsp;</td>
                    <td id="prijs"><?php echo($_SESSION["amounts"][$i]); ?></td>
                    <td width="10px">&nbsp;</td>
                    <td><input class="btn btn-primary" onclick="totaalPrijs()" type="submit" value="Update winkelwagen"></td>
                    <td width="10px"></td>
                    <td><a class="btn btn-danger" href="?delete=<?php echo($i); ?>">Verwijder uit winkelwagen</a></td>
                </tr>
            </form>
            <?php
            $total = $total + $_SESSION["amounts"][$i];
        }
        $_SESSION["total"] = $total;
        ?>
        <tr>
            <td id="totaalPrijs" colspan="7">Totaal: *</td>
        </tr>
    </table>
<?php } ?>

<?php
if ($check == 0) {
    print("<h3>Uw winkelwagen is leeg!</h3><br>");
    ?> <form action="ShoppingCartVoorbeeld.php">
    <input type="submit" value="Terug naar winkel">
    </form>
    <?php
} else {
    ?>
    <tr>
        <td colspan="5"></td>
    </tr>
    <tr>
        <td colspan="5"><a href="?reset=true">Reset winkelwagen</a></td>
    </tr>
<?php } ?>

<!--<script>
    function totaalPrijs() {
        var hoeveelheid = document.getElementById("hoeveelheid").value;
        var prijs = document.getElementById("prijs").innerHTML;

        var totaal = hoeveelheid * prijs;

        var totaalPrijs = document.getElementById("totaalPrijs");

        totaalPrijs.innerHTML = "Totaal: " + totaal;
    }
</script>-->

<?php include(ROOT_PATH . "/includes/footer.php"); ?>
