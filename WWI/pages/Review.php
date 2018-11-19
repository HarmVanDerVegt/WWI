<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include_once ROOT_PATH . "/includes/header.php";

include_once(ROOT_PATH . "/controllers/reviewController.php");

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <title></title>
    </head>
    <body>        
        <div class="container">
            <div class="row col-3 no-gutters">
            
                <?php 
            $review = filter_input(INPUT_POST, "ster", FILTER_VALIDATE_INT); 
            if(empty($review)) {
                $review = 3;
            }
            
            print(getCurrentReviewValue($review));
            
            ?>
            </div>
        </div>
    </body>
</html>
