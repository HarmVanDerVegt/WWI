<!DOCTYPE html>

<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="\WWI\WWI\css\bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <!-- voegt header toe -->
            <?php include(ROOT_PATH . "/includes/header.php"); ?>
        <br>
        
<!-- begin categorie knoppen------------------------------------------------------------------------------ -->
        <!-- category informatie ophalen -->
            <?php
            // speciale data type voor category informatie
            class category_type {
                public $category = "";
                public $foto_path = "";
                public $link = "";
            }

            // laad category data
            include('data/category_data.php');
            ?>
       
        <!-- laat de product categoryen zien -->
            <?php
            // variablen
            $height = 100;
            $width = 100;

            // genereer html code die de category's laat zien
            print('<div class="container">');
            print("<h1>Category:</h1>");
            print('<div class="row">');
            
            foreach ($category as $item) {
                // toon kaart met naam en foto van category
                print('<div class="col-6 col-sm-4">');
                    print('<div class="card">');
                        print('<a href="' . $item->link . '" class="btn btn-info" role="button">');
                            print('<strong>' . $item->category . '</strong><br>');
                            print('<img src="' . $item->foto_path . '" alt="' . $item->category . '" height="' . $height . 'px" width="' . $width . 'px">');
                        print('</a>');
                    print('</div>');
                print('</div>');
            }

            print('</div>');
            print('</div>');
            ?>
<!-- einde category knoppen------------------------------------------------------------------------------ -->
        <!-- voeg footer toe -->
            <br>
            <?php include(ROOT_PATH . "/includes/footer.php"); ?>
    </body>
</html>
