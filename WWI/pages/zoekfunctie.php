<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
a}

include(ROOT_PATH . "/includes/header.php");
include_once(ROOT_PATH . "/controllers/stockItemController.php");
include_once(ROOT_PATH . "/controllers/stockGroupsController.php");

?>

<table>
<form action="zoekfunctie.php" method="get">
<tr>
    <td>naam : </td><td><input type="text" name="naam"></td>
</tr>
<tr><td>    <?php foreach (getSearchTags() as $tag){
        echo ("<input type=\"checkbox\" name=\"tag\" value=\"$tag->$tag\">");
    }?>
</td></tr>
<tr>
    <div class="dropdown">
        <button class="dropbtn">Categorieën<i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="#">a</a>
            <a href="#">b</a>
            <a href="#">c</a>
        </div>
    </div>

</tr>
</form>
</table>
