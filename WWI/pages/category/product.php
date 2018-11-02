<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="\WWI\WWI\css\bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <title>Category</title>
    </head>
    <body>
        <!-- path fix -->
        <?php
        if (!defined('ROOT_PATH')) {
            include("../../config.php");
        }
        ?>
        <!-- voegt header toe -->
        <?php include(ROOT_PATH . "/includes/header.php"); ?>
        <br>
        <!-- constanten -->
        <?php
        $height = 200;
        $width = 300;
        ?>

        <!-- verzamel data van product -->
        <?php
        // hier moet de sql data in de goede variablen terecht komen
        $product_naam = "test_product_naam";
        $product_merk = "test";
        $product_prijs = 20;
        $product_voorraad = 100;
        $product_bezorg_info = "in 4 to 5 werkdagen leverbaar";
        $product_afbeelding_path = "../media/noveltyitems.jpg";
        $product_specs = "veel dingen";
        $product_beschrijving = "het is een beschrijving";
        $product_review = "dit is een revieuw";
        ?>

        <!-- Header naam, merk, prijs, voorraad -->
        <div class="card">
            <div class="card-body">
                <!-- Toon naam van product -->
                <div class="card-header">
                    <td><h1><?php print($product_naam); ?></h1></td>
                </div>
                <table>
                    <!-- Toon de globale informatie van product -->
                    <tr>
                        <!-- toon merk van product -->
                        <td>
                            <?php print("<b>Merk:</b>" . $product_merk); ?>
                        </td>
                        <!-- toon prijs en voorraad  en informatie over bezorging-->
                        <td>
                            <?php print("<b>Prijs: </b>€" . $product_prijs); ?>
                            <br>
                            <?php print("<b>voorraad: </b>" . $product_voorraad); ?>
                            <br>
                            <?php print($product_bezorg_info); ?>
                        </td>
                        <!-- bestel knop -->
                        <td>
                            <form>
                                <input type="submit" value="bestellen">
                            </form>
                        </td>
                    </tr>
                    <!-- Toon product afbeelding -->
                    <tr>
                        <td>
                            <img class="img-thumbnail" src="<?php print($product_afbeelding_path); ?>" alt="Afbeelding <?php print($product_naam); ?>" height="<?php print($height); ?>px" width="<?php print($width); ?>px" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <!-- product informatie weergeven-->
        <div class="container-fluid">
            
            <!-- Toon specificaties -->
            <div class="row">
                <div class="col-sm-8">
                    <div class="bg-light">
                        <h4>Specs:</h4>
                        <p><?php print($product_specs); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- toon product beschrijving -->
            <div class="row">
                <div class="col-sm-8" >
                    <div class="bg-light">
                        <h4>Product beschrijving:</h4>
                        <p><?php print($product_beschrijving); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- Toont product reviews -->
            <div class="row">
                <div class="col-sm-8" >
                    <div class="bg-light">
                        <h4>revieuws:</h4>
                        <p><?php print($product_review); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- toon combi deals -->
            <div class="row">
                <div class="col-lg-8" >
                    <div class="bg-light">
                        <h4>combideals:</h4>
                        <p>test</p>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- voeg footer toe -->
        <br>
        <?php include(ROOT_PATH . "/includes/footer.php"); ?>
    </body>
</html>
