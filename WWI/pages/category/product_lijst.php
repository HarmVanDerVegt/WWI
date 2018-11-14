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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // vind meegegeven variable van url
        // category id naam ophalen
        if (filter_has_var(INPUT_GET, "category")) {
            $category_naam = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING);
        } else {
            if (isset($_SESSION['category'])) {
                $category_naam = $_SESSION['category'];
            } else {
                $category_naam = "Mugs";
            }
        }
        $_SESSION["category"] = $category_naam;
        
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
        <!-- Titel van pagina -->
        <h1>category:&emsp;<?php print($category_naam); ?></h1>
        <!-- resultaat informatie van opgehaalde producten -->
        <?php
        $aantal_producten = mysqli_num_rows($resultaat);
        // welke pagina moet worden getoond
        if (filter_has_var(INPUT_GET, "aantal_producten")) {
            $aantal_producten_tonen = filter_input(INPUT_GET, "aantal_producten", FILTER_VALIDATE_INT);
        } else {
            // default aantal producten zien
            $aantal_producten_tonen = 8;
        }
        $paginas = (int) ceil($aantal_producten / $aantal_producten_tonen);

        if (filter_has_var(INPUT_GET, "pagina")) {
            $pagina_nr = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
        } else {
            $pagina_nr = 1;
        }
        ?>
        <!-- vraag gebruiker hoeveel itmes wil zien -->
        <form>
            Aantal producten tonen:
            <select name="aantal_producten">
                <?php
                for ($i = 2; $i <= 32; $i *= 2) {
                    print("<option " . (($i == $aantal_producten_tonen) ? "selected" : "") . ">" . $i . "</option>");
                }
                ?>
            </select>
            <input type="submit" value="laad">
            Pagina:
            <?php
            print("<button type='submit' name='pagina' value='".(($pagina_nr-1 > 0) ? $pagina_nr-1 : 1)."'><<</button>");
            for ($i = 1; $i <= $paginas; $i++) {
                print("<input type='submit' name='pagina' value='" . $i . "'");
                // kleur de geselecteerde knop
                print(" ".(($i == $pagina_nr) ? "style='background-color:blue; color:white;'" : "").">");
            }
            print("<button type='submit' name='pagina' value='".(($pagina_nr+1 <= $paginas) ? $pagina_nr+1 : $paginas)."'>>></button>");
            ?>
        </form>

        <!-- genereren van generieke pagina -->
        <div class="container">
            <div class="row">
                <?php
                for ($i = 0; $i < ($pagina_nr - 1) * $aantal_producten_tonen; $i++) {
                    mysqli_fetch_assoc($resultaat);
                }
                for ($loop = 0; $loop < $aantal_producten_tonen; $loop++) {
                    // laad gegevens van een rij 
                    $item = mysqli_fetch_assoc($resultaat);
                    if ($item == NULL)
                        break;
                    // --------------------------doe benodige gegevens in variablen                    
                    $naam = explode("-", $item["StockItemName"]);
                    $foto_path = "../media/airline.jpg";
                    $prijs = $item["UnitPrice"];
                    $merk = $item["brand"];
                    $gewicht = $item["TypicalWeightPerUnit"];
                    $product_id = $item["StockItemID"];

                    // -------------------------ga naar een nieuwe rij na elke 2 items
                    if ($loop % 2 == 0) {
                        print('</div><div class="row">');
                    }

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
                    if (isset($naam[1]))
                        print('<textarea rows="2" cols="5">' . $naam[1] . '</textarea>');
                    if ($merk != NULL)
                        print('<br>Merk : ' . $merk . '<br>');
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
