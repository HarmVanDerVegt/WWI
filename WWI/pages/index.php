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
        
        <!-- category informatie -->
        <?php
            // speciale data type voor category informatie
            class category_type {
                public $category = "";
                public $foto_path = "";
                public $link = "";
            }
        
            // catecory informatie ophalen
            $i=0;
            $category[$i] = new category_type();
            $category[$i]->category="Airline Novelties";
            $category[$i]->foto_path="media/airline.jpg";
            $category[$i]->link="category/airlinenovelties.php";
            
            $i++;
            $category[$i] = new category_type();
            $category[$i]->category="Clothing";
            $category[$i]->foto_path="media/clothing.jpg";
            $category[$i]->link="category/clothing.php";
            
            $i++;
            $category[$i] = new category_type();
            $category[$i]->category="Computing Novelties";
            $category[$i]->foto_path="media/computingnovelties.jpg";
            $category[$i]->link="category/computingnovelties.php";
            
            $i++;
            $category[$i] = new category_type();
            $category[$i]->category="Furry Footwear";
            $category[$i]->foto_path="media/furryfootwear.jpg";
            $category[$i]->link="category/furryfootwear.php";
            
            $i++;
            $category[$i] = new category_type();
            $category[$i]->category="Furry Footwear";
            $category[$i]->foto_path="media/furryfootwear.jpg";
            $category[$i]->link="category/furryfootwear.php";
            
            $i++;
            $category[$i] = new category_type();
            $category[$i]->category="Furry Footwear";
            $category[$i]->foto_path="media/furryfootwear.jpg";
            $category[$i]->link="category/furryfootwear.php";
            
        ?>
        
        <!-- laat de product categoryen zien -->
        <?php
            // variablen
            $height=100;
            $width=100;
            
            // genereer html code die de category's laat zien
            print('<div class="container">');
            print('<div class="row">');
            $i=0;
            foreach($category as $item){
                // toon kaart met naam en foto van category
                print('<div class="col">');
                print('<div class="card">');
                print('<a href="'.$item->link.'" class="btn btn-info" role="button">');
                print('<h1>'.$item->category.'</h1>');
                print('<img src="'.$item->foto_path.'" alt="'.$item->category.'" height="'.$height.'px" width="'.$width.'px">');
                print('</a>');
                print('</div>');
                print('</div>');
                
                // zorgt er voor dat de kolomen beperkt worden met 3
                $i++;
                if($i > 2){
                    print('</div><div class="row">');
                    $i=0;
                }
            }
            print('</div>');
            print('</div>');
        ?>
        
            <!--
                !<a href="category/airlinenovelties.php"><h1>Airline Novelties</h1><img src="media/airline.jpg" alt="airlinenovelties" height="300px" width="300px"></a>
                !<a href="category/clothing.php"><h1>Clothing</h1><img src="media/clothing.jpg" alt="clothing" height="300px" width="300px"></a>
                !<a href="category/computingnovelties.php"><h1>Computing Novelties</h1><img src="media/computingnovelties.jpg" alt="computingnovelties" height="300px" width="300px"></a>
                !<a href="category/furryfootwear.php"><h1>Furry Footwear</h1><img src="media/furryfootwear.jpg" alt="furryfootwear" height="300px" width="300px"></a>
                <a href="category/mugs.php"><h1>Mugs</h1><img src="media/mugs.jpg" alt="mugs" height="300px" width="300px"></a>
                <a href="category/noveltyitems.php"><h1>Novelty Items</h1><img src="media/noveltyitems.jpg" alt="noveltyitems" height="300px" width="300px"></a>
                <a href="category/packagingmaterials.php"><h1>Packaging Materials</h1><img src="/fotos/" alt="packagingmaterials" height="300px" width="300px"></a>
                <a href="category/toys.php"><h1>Toys</h1><img src="media/toys.jpg" alt="toys" height="300px" width="300px"></a>
                <a href="category/tshirts.php"><h1>T-shirts</h1><img src="media/toys.jpg" alt="tshirts" height="300px" width="300px"></a>
                <a href="category/usbnovelties.php"><h1>USB Novelties</h1><img src="media/usbnovelties.jpg" alt="usbnovelties" height="300px" width="300px"></a>
            -->
        <br>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>
    </body>
</html>
