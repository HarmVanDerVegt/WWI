<?php
/**
 * Created by PhpStorm.
 * User: lexkruiper97
 * Date: 5-12-2018
 * Time: 09:40
 */


if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include_once ROOT_PATH . "/controllers/reviewController.php";

$count =1;
while ($count < 5000) {
   insertReviewValue(rand(1001, 3311), rand(1, 277), rand(1, 5));
$count ++;
}