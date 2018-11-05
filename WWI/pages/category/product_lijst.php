<!DOCTYPE html>
<!-- SELECT SI.StockItemName,SI.brand,SI.TaxRate,SI.UnitPrice,SI.RecommendedRetailPrice,SI.TypicalWeightPerUnit,SI.Photo,SG.StockGroupName\n -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Product Lijst</title>
        <!-- fix path -->
        <?php
        if (!defined('ROOT_PATH')) {
            include("../../config.php");
        }
        ?>
    </head>
    <body>
        <!-- producten ophallen van database -->
        <?php
        // -------------variablen
        // vind meegegeven variable van url
        if (filter_has_var(INPUT_GET, "category")) {
            $category_naam = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING);
        } else {
            $category_naam = "Mugs";
        }
        // sql query voor het vinden van de goede producten
        $sql_code = ""
                . "SELECT SI.StockItemID, SI.StockItemName,SI.brand,SI.UnitPrice,SI.TypicalWeightPerUnit "
                . "FROM stockitems SI "
                . "JOIN stockitemstockgroups SI_SG "
                . "ON SI.StockItemID = SI_SG.StockItemID "
                . "JOIN stockgroups SG "
                . "ON SI_SG.StockGroupID=SG.StockGroupID "
                . "WHERE SG.StockGroupName='".$category_naam."' ";

        // conect met sql server
        $sql_connectie = mysqli_connect('localhost', 'root', '', 'wideworldimporters');

        // check of conectie is sucsesvol
        if (!$sql_connectie) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // items opvragen uit sql data base
        $resultaat = mysqli_query($sql_connectie, $sql_code);
        ?>
        <!-- inhoud pagina------------------------------------------ -->
        <?php include(ROOT_PATH . "/includes/header.php"); ?>
        <br>
        <!-- -->
        <h1>category:&emsp;<?php print($category_naam); ?></h1>
        <!-- genereren van generieke tabel met producten -->
        <table border="1" class="d-flex p-2 justify-content-center table-striped">
            <tr>
                <th>Prijs per stuk</th>
                <th>Naam</th>
                <th>Merk</th>
                <th>Gewicht</th>
                <th>Link</th>
            </tr>
            <?php
            // print de rijen met informatie over producten uit database
            while ($item = mysqli_fetch_assoc($resultaat)) {
                print("<tr>");
                $stockItemID = $item["StockItemID"];
                print("<td>" . $item["UnitPrice"] . "</td>");
                print("<td>" . $item["StockItemName"] . "</td>");
                print("<td>" . $item["brand"] . "</td>");
                print("<td>" . $item["TypicalWeightPerUnit"] . "</td>");
                print("<td>" . '<a href="/WWI/WWI/pages/category/product.php?productID=' . $stockItemID . '">Link</a></td>');
                print("</tr>");
            }
            ?>
        </table>
        <!-- einde inhoud pagina ----------------------------------- -->
        <br>
        <?php include(ROOT_PATH . "/includes/footer.php"); ?>

    </body>
</html>
