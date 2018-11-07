<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/supplierController.php";
?>


<br>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $StockItem = getStockItemByID(6);
                        $Supplier = getSupplierByID($StockItem["SupplierID"]);
                        echo "Naam: " . $StockItem["StockItemName"] . "<br>";
                        
                        if ($StockItem["Photo"] != NULL) {
                            ?> <img src=<?php $StockItem["Photo"] ?> alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        } else {
                            ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        }
                        
                        if ($StockItem["RecommendedRetailPrice"] != NULL) {
                            echo "De prijs is: €" . $StockItem["RecommendedRetailPrice"] . " euro" . "<br>";
                        } else {
                            echo "De prijs is: €" . $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 100) . " euro" . "<br>";
                        }
                        
                        if ($StockItem["Size"] != NULL) {
                            echo "Grootte is: " . $StockItem["Size"] . "<br>";
                        }
                        if ($StockItem["ColorID"] != NUlL) {
                            echo "Kleur is: " . $StockItem["ColorID"] . "<br>";
                        }
                        echo "Het gewoonlijke gewicht per eenheid is: " . $StockItem["TypicalWeightPerUnit"];
                        if ($StockItem["TypicalWeightPerUnit"] >= 1) {
                            echo " kilo" . "<br>";
                        } else {
                            echo " gram" . "<br>";
                        }
                        if ($StockItem["MarketingComments"] != NULL) {
                            echo $StockItem["MarketingComments"];
                        }
                        if ($StockItem["IsChillerStock"] == TRUE) {
                            echo "Dit is een koelproduct";
                        }
                        echo "Dit product word geleverd door " . $Supplier["SupplierName"];
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>

                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $StockItem = getStockItemByID(24);
                        $Supplier = getSupplierByID($StockItem["SupplierID"]);

                        echo "Naam: " . $StockItem["StockItemName"] . "<br>";
                        if ($StockItem["Photo"] != NULL) {
                            ?> <img src=<?php $StockItem["Photo"] ?> alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        } else {
                            ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        }
                        if ($StockItem["RecommendedRetailPrice"] != NULL) {
                            echo "De prijs is: €" . $StockItem["RecommendedRetailPrice"] . " euro" . "<br>";
                        } else {
                            echo "De prijs is: €" . $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 100) . " euro" . "<br>";
                        }
                        if ($StockItem["Size"] != NULL) {
                            echo "Grootte is: " . $StockItem["Size"] . "<br>";
                        }
                        if ($StockItem["ColorID"] != NUlL) {
                            echo "Kleur is: " . $StockItem["ColorID"] . "<br>";
                        }
                        echo "Het gewoonlijke gewicht per eenheid is: " . $StockItem["TypicalWeightPerUnit"];
                        if ($StockItem["TypicalWeightPerUnit"] >= 1) {
                            echo " kilo" . "<br>";
                        } else {
                            echo " gram" . "<br>";
                        }
                        if ($StockItem["IsChillerStock"] == TRUE) {
                            echo "Dit is een koelproduct";
                        }
                        echo "Dit product word geleverd door " . $Supplier["SupplierName"];
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $StockItem = getStockItemByID(42);
                        $Supplier = getSupplierByID($StockItem["SupplierID"]);


                        echo "Naam: " . $StockItem["StockItemName"] . "<br>";
                        if ($StockItem["Photo"] != NULL) {
                            ?> <img src=<?php $StockItem["Photo"] ?> alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        } else {
                            ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        }
                        if ($StockItem["RecommendedRetailPrice"] != NULL) {
                            echo "De prijs is: €" . $StockItem["RecommendedRetailPrice"] . " euro" . "<br>";
                        } else {
                            echo "De prijs is: €" . $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 100) . " euro" . "<br>";
                        }
                        if ($StockItem["Size"] != NULL) {
                            echo "Grootte is: " . $StockItem["Size"] . "<br>";
                        }
                        if ($StockItem["ColorID"] != NUlL) {
                            echo "Kleur is: " . $StockItem["ColorID"] . "<br>";
                        }
                        echo "Het gewoonlijke gewicht per eenheid is: " . $StockItem["TypicalWeightPerUnit"];
                        if ($StockItem["TypicalWeightPerUnit"] >= 1) {
                            echo " kilo" . "<br>";
                        } else {
                            echo " gram" . "<br>";
                        }
                        if ($StockItem["IsChillerStock"] == TRUE) {
                            echo "Dit is een koelproduct";
                        }
                        echo "Dit product word geleverd door " . $Supplier["SupplierName"];
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $StockItem = getStockItemByID(217);
                        $Supplier = getSupplierByID($StockItem["SupplierID"]);


                        echo "Naam: " . $StockItem["StockItemName"] . "<br>";
                        if ($StockItem["Photo"] != NULL) {
                            ?> <img src=<?php $StockItem["Photo"] ?> alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        } else {
                            ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        }
                        if ($StockItem["RecommendedRetailPrice"] != NULL) {
                            echo "De prijs is: €" . $StockItem["RecommendedRetailPrice"] . " euro" . "<br>";
                        } else {
                            echo "De prijs is: €" . $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 100) . " euro" . "<br>";
                        }
                        if ($StockItem["Size"] != NULL) {
                            echo "Grootte is: " . $StockItem["Size"] . "<br>";
                        }
                        if ($StockItem["ColorID"] != NUlL) {
                            echo "Kleur is: " . $StockItem["ColorID"] . "<br>";
                        }
                        echo "Het gewoonlijke gewicht per eenheid is: " . $StockItem["TypicalWeightPerUnit"];
                        if ($StockItem["TypicalWeightPerUnit"] >= 1) {
                            echo " kilo" . "<br>";
                        } else {
                            echo " gram" . "<br>";
                        }
                        if ($StockItem["IsChillerStock"] == TRUE) {
                            echo "Dit is een koelproduct";
                        }
                        echo "Dit product word geleverd door " . $Supplier["SupplierName"];
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $StockItem = getStockItemByID(225);
                        $Supplier = getSupplierByID($StockItem["SupplierID"]);


                        echo "Naam: " . $StockItem["StockItemName"] . "<br>";
                        if ($StockItem["Photo"] != NULL) {
                            ?> <img src=<?php $StockItem["Photo"] ?> alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        } else {
                            ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        }
                        if ($StockItem["RecommendedRetailPrice"] != NULL) {
                            echo "De prijs is: €" . $StockItem["RecommendedRetailPrice"] . " euro" . "<br>";
                        } else {
                            echo "De prijs is: €" . $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 100) . " euro" . "<br>";
                        }
                        if ($StockItem["Size"] != NULL) {
                            echo "Grootte is: " . $StockItem["Size"] . "<br>";
                        }
                        if ($StockItem["ColorID"] != NUlL) {
                            echo "Kleur is: " . $StockItem["ColorID"] . "<br>";
                        }
                        echo "Het gewoonlijke gewicht per eenheid is: " . $StockItem["TypicalWeightPerUnit"];
                        if ($StockItem["TypicalWeightPerUnit"] >= 1) {
                            echo " kilo" . "<br>";
                        } else {
                            echo " gram" . "<br>";
                        }
                        if ($StockItem["IsChillerStock"] == TRUE) {
                            echo "Dit is een koelproduct" . "<br>";
                        }
                        echo "Dit product word geleverd door " . $Supplier["SupplierName"];
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $StockItem = getStockItemByID(60);
                        $Supplier = getSupplierByID($StockItem["SupplierID"]);


                        echo "Naam: " . $StockItem["StockItemName"] . "<br>";
                        if ($StockItem["Photo"] != NULL) {
                            ?> <img src=<?php $StockItem["Photo"] ?> alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        } else {
                            ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        }
                        if ($StockItem["RecommendedRetailPrice"] != NULL) {
                            echo "De prijs is: €" . $StockItem["RecommendedRetailPrice"] . " euro" . "<br>";
                        } else {
                            echo "De prijs is: €" . $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 100) . " euro" . "<br>";
                        }
                        if ($StockItem["Size"] != NULL) {
                            echo "Grootte is: " . $StockItem["Size"] . "<br>";
                        }
                        if ($StockItem["ColorID"] != NUlL) {
                            echo "Kleur is: " . $StockItem["ColorID"] . "<br>";
                        }
                        echo "Het gewoonlijke gewicht per eenheid is: " . $StockItem["TypicalWeightPerUnit"];
                        if ($StockItem["TypicalWeightPerUnit"] >= 1) {
                            echo " kilo" . "<br>";
                        } else {
                            echo " gram" . "<br>";
                        }
                        if ($StockItem["IsChillerStock"] == TRUE) {
                            echo "Dit is een koelproduct";
                        }
                        echo "Dit product word geleverd door " . $Supplier["SupplierName"];
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $StockItem = getStockItemByID(69);
                        $Supplier = getSupplierByID($StockItem["SupplierID"]);


                        echo "Naam: " . $StockItem["StockItemName"] . "<br>";
                        if ($StockItem["Photo"] != NULL) {
                            ?> <img src=<?php $StockItem["Photo"] ?> alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        } else {
                            ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        }
                        if ($StockItem["RecommendedRetailPrice"] != NULL) {
                            echo "De prijs is: €" . $StockItem["RecommendedRetailPrice"] . " euro" . "<br>";
                        } else {
                            echo "De prijs is: €" . $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 100) . " euro" . "<br>";
                        }
                        if ($StockItem["Size"] != NULL) {
                            echo "Grootte is: " . $StockItem["Size"] . "<br>";
                        }
                        if ($StockItem["ColorID"] != NUlL) {
                            echo "Kleur is: " . $StockItem["ColorID"] . "<br>";
                        }
                        echo "Het gewoonlijke gewicht per eenheid is: " . $StockItem["TypicalWeightPerUnit"];
                        if ($StockItem["TypicalWeightPerUnit"] >= 1) {
                            echo " kilo" . "<br>";
                        } else {
                            echo " gram" . "<br>";
                        }
                        if ($StockItem["IsChillerStock"] == TRUE) {
                            echo "Dit is een koelproduct";
                        }
                        echo "Dit product word geleverd door " . $Supplier["SupplierName"];
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $StockItem = getStockItemByID(14);
                        $Supplier = getSupplierByID($StockItem["SupplierID"]);


                        echo "Naam: " . $StockItem["StockItemName"] . "<br>";
                        if ($StockItem["Photo"] != NULL) {
                            ?> <img src=<?php $StockItem["Photo"] ?> alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        } else {
                            ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        }
                        if ($StockItem["RecommendedRetailPrice"] != NULL) {
                            echo "De prijs is: €" . $StockItem["RecommendedRetailPrice"] . " euro" . "<br>";
                        } else {
                            echo "De prijs is: €" . $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 100) . " euro" . "<br>";
                        }
                        if ($StockItem["Size"] != NULL) {
                            echo "Grootte is: " . $StockItem["Size"] . "<br>";
                        }
                        if ($StockItem["ColorID"] != NUlL) {
                            echo "Kleur is: " . $StockItem["ColorID"] . "<br>";
                        }
                        echo "Het gewoonlijke gewicht per eenheid is: " . $StockItem["TypicalWeightPerUnit"];
                        if ($StockItem["TypicalWeightPerUnit"] >= 1) {
                            echo " kilo" . "<br>";
                        } else {
                            echo " gram" . "<br>";
                        }
                        if ($StockItem["IsChillerStock"] == TRUE) {
                            echo "Dit is een koelproduct";
                        }
                        echo "Dit product word geleverd door " . $Supplier["SupplierName"];
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $StockItem = getStockItemByID(88);
                        $Supplier = getSupplierByID($StockItem["SupplierID"]);


                        echo "Naam: " . $StockItem["StockItemName"] . "<br>";
                        if ($StockItem["Photo"] != NULL) {
                            ?> <img src=<?php $StockItem["Photo"] ?> alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        } else {
                            ?> <img src="media/ProductFotoNietBeschikbaar" alt="FotoNietGevonden" height="250px" width="250px"> <?php
                        }
                        if ($StockItem["RecommendedRetailPrice"] != NULL) {
                            echo "De prijs is: €" . $StockItem["RecommendedRetailPrice"] . " euro" . "<br>";
                        } else {
                            echo "De prijs is: €" . $StockItem["UnitPrice"] * ($StockItem["TaxRate"] / 100 + 100) . " euro" . "<br>";
                        }
                        if ($StockItem["Size"] != NULL) {
                            echo "Grootte is: " . $StockItem["Size"] . "<br>";
                        }
                        if ($StockItem["ColorID"] != NUlL) {
                            echo "Kleur is: " . $StockItem["ColorID"] . "<br>";
                        }
                        echo "Het gewoonlijke gewicht per eenheid is: " . $StockItem["TypicalWeightPerUnit"];
                        if ($StockItem["TypicalWeightPerUnit"] >= 1) {
                            echo " kilo" . "<br>";
                        } else {
                            echo " gram" . "<br>";
                        }
                        if ($StockItem["IsChillerStock"] == TRUE) {
                            echo "Dit is een koelproduct";
                        }
                        echo "Dit product word geleverd door " . $Supplier["SupplierName"];
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>