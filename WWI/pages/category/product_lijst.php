<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="\WWI\WWI\css\card.css" rel="stylesheet" type="text/css"/>
        <title>Product Lijst</title>
        <!-- fix path -->
        <?php
        if (!defined('ROOT_PATH')) {
            include("../../config.php");
        }

        include_once ROOT_PATH . "/controllers/stockItemController.php";
        ?>



    </head>
    <body>
        <!-- Producten ophalen van database -->
        <?php
        // -------------variablen
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Zoek meegegeven variable van url
        // Category id naam ophalen
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

        // SQL query voor het vinden van de goede producten
        $sql_code = ""
                . "SELECT * "
                . "FROM stockitems SI "
                . "JOIN stockitemstockgroups SI_SG "
                . "ON SI.StockItemID = SI_SG.StockItemID "
                . "JOIN stockgroups SG "
                . "ON SI_SG.StockGroupID=SG.StockGroupID "
                . "WHERE SG.StockGroupName='" . $category_naam . "' ";

        // Connect met sql server
        $sql_connectie = mysqli_connect('localhost', 'root', '', 'wideworldimporters');

        // Check of de connectie succesvol is
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
        <h1>Categorie: <?php print($category_naam); ?></h1>
        <!-- resultaat informatie van opgehaalde producten -->
        <?php
        $aantal_producten = mysqli_num_rows($resultaat);
        // welke pagina moet worden getoond
        if (filter_has_var(INPUT_GET, "aantal_producten")) {
            $aantal_producten_tonen = filter_input(INPUT_GET, "aantal_producten", FILTER_VALIDATE_INT);
        } else {
            // default aantal producten zien
            $aantal_producten_tonen = 6;
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
                for ($i = 6; $i <= 30; $i += 6) {
                    print("<option " . (($i == $aantal_producten_tonen) ? "selected" : "") . ">" . $i . "</option>");
                }
                ?>
            </select>
            <input type="submit" value="laad">
            Pagina:
            <?php
            print("<button type='submit' name='pagina' value='" . (($pagina_nr - 1 > 0) ? $pagina_nr - 1 : 1) . "'><<</button>");
            for ($i = 1; $i <= $paginas; $i++) {
                print("<input type='submit' name='pagina' value='" . $i . "'");
                // kleur de geselecteerde knop
                print(" " . (($i == $pagina_nr) ? "style='background-color:blue; color:white;'" : "") . ">");
            }
            print("<button type='submit' name='pagina' value='" . (($pagina_nr + 1 <= $paginas) ? $pagina_nr + 1 : $paginas) . "'>>></button>");
            ?>
        </form>

        <!-- genereren van generieke pagina -->
        <div class="py-2">
            <div class="container">
                <div class="row hidden-md-up">
                    <?php
                    for ($i = 0; $i < ($pagina_nr - 1) * $aantal_producten_tonen; $i++) {
                        mysqli_fetch_assoc($resultaat);
                    }
                    for ($loop = 0; $loop < $aantal_producten_tonen; $loop++) {
                        // laad gegevens van een rij 
                        $item = mysqli_fetch_assoc($resultaat);
                        if ($item == NULL){
                            break;}

                        // --------------------------doe benodige gegevens in variablen   
                        $naam = explode("_", $item["StockItemName"]);
                        if ($item["RecommendedRetailPrice"] != NULL) {
                            $prijs = $item["RecommendedRetailPrice"];
                        } else {
                            $prijs = $item["UnitPrice"] * ($item["TaxRate"] / 100 + 1);
                        }
                        if ($prijs == NULL) {
                            print("Er is geen prijs voor dit product beschikbaar" . "<br>");
                        }
                        $merk = $item["Brand"];
                        $gewicht = $item["TypicalWeightPerUnit"];
                        $product_id = $item["StockItemID"];

                        // -------------------------- Zoek een productfoto 
                        $StockGroups = getStockGroupIDsFromStockItemID($product_id);
                        $SingleStockGroup = array_rand($StockGroups, 1);
                        $product_afbeelding_path = getImageLinkFromStockGroupID($StockGroups[$SingleStockGroup]);

                        // -------------------------ga naar een nieuwe rij na elke 2 items
                        if ($loop % 3 == 0) {
                            print('</div></div></div><div class="py-2"><div class="container"><div class="row hidden-md-up">');
                        }

                        // ---------------------------------------maak een kaart
                        print('<div class="col-md-4">
						     <div class="card-custom">
                               <div class="card-block">
                                 <a href="/WWI/WWI/pages/category/product.php?productID=' . $product_id . '" class="card-link"><img class="card-img-top" src="' . $product_afbeelding_path . ' "  alt="Card image cap" style="max-width:382px;max-height:180px;" ></a>
<<<<<<< HEAD
                                 <h4 class="card-custom-title text-light">' . $naam[0] . '</h4>
                                 <p class="card-text p-y-1 text-light"> Prijs: €' . $prijs . ' euro </p>
=======
                                 <a href="/WWI/WWI/pages/category/product.php?productID=' . $product_id . '" <h4 class="card-custom-title text-light">' . $naam[0] . '</h4> </a>
                                 
                                 <p class="card-text p-y-1 text-light"> €' . $prijs . '</p>
>>>>>>> e4fb8cab6780567b19fb0d40a228c514fa68acaa
                               </div>
                             </div>
                           </div>');
                    }
                    ?>
                </div>
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
