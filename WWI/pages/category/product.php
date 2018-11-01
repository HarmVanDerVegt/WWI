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
        
        <!-- Header -->
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
        
        <!-- product informatie weergeven-->
        <br>
        <div class="container-fluid">
            <!-- Toon specificaties -->
            <div class="row">
                <div class="col-auto">
                    <div class="card">
                        <h2>Specs:</h2>
                        <p><?php print($product_specs); ?></p>
                        <br>
                    </div>
                </div>
            </div>
            
            <!-- toon product beschrijving -->
            <div class="row">
                <div class="col-auto">
                    <div class="card">
                        <h2>Product beschrijving:</h2>
                        <p><?php print($product_beschrijving); ?></p>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Toont product reviews -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto">
                    <div class="card">
                        <h2>revieuws:</h2>
                        <p><?php print($product_review); ?></p>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- toon combi deals -->
           <div class="row-md-4 offset-md-4">
                combiedeals
           </div>
    </body>
</html>
