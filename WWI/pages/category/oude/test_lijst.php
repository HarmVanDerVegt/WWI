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
                . "WHERE SG.StockGroupName='" . $category_naam . "' ";

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
        <!-- vraag gebruiker hoeveel itmes wil zien -->
        <form>
            Aantal pagina's:
            <select name="aantal_producten">
                <option>2</option>
                <option>4</option>
            </select>
            <input type="submit" value="laad">
        </form>
        <!-- genereren van generieke pagina -->
        <div class="container">
            <div class="row">
                <?php
                $i = 0;
                while ($item = mysqli_fetch_assoc($resultaat)) {
                    // constanten voor generatie pagina
                    $aantal_items = 2;
                    
                    // --------------------------doe benodige gegevens in variablen                    
                    $naam = explode("-", $item["StockItemName"]);
                    $foto_path = "../media/airline.jpg";
                    $prijs = $item["UnitPrice"];
                    $merk = $item["brand"];
                    $gewicht = $item["TypicalWeightPerUnit"];
                    $product_id = $item["StockItemID"];

                    // -------------------------ga naar een nieuwe rij na elke 4 items
                    if ($i > $aantal_items-1) {
                        $i = 0;
                        print('</div><div class="row">');
                    }
                    $i++;

                    // ---------------------------------------maak een kaart
                    print('<a href="/WWI/WWI/pages/category/product.php?productID=' . $product_id . '" class="btn" role="button" style="length: 100px;"0>');
                    // de naam van het product
                    print('<div class="card">');
                    print($naam[0]);
                    print('</div>');
                    print('<div class="card-group">');
                    // de afbeelding van product
                    print('<div class="card">');
                    print('<img class="card-img" src="' . $foto_path . '" width="200" height="200"/>');
                    print('</div>');
                    // de gegevens van het product
                    print('<div class="card">');
                    print('Prijs : ' . $prijs);
                    print('<br>beschrijving :<br>');
                    print('<textarea rows="2" cols="5">' . $naam[1] . '</textarea>');
                    if($merk != NULL) print('<br>Merk : ' . $merk . '<br>');
                    print('<br>Gewicht : ' . $gewicht . '<br>');
                    print('</div>');

                    print('</div>');
                    print('</a>');
                    
                   
                }
                ?>
            </div>
        </div>
        <!-- einde genereren pagina -->
        <!-- sluiten van sql connectie -->
        <?php
        $sql_connectie = NULL;
        ?>
        <!-- einde inhoud pagina ----------------------------------- -->
        <br>
        <?php include(ROOT_PATH . "/includes/footer.php"); ?>

    </body>
</html>
