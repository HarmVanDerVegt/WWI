<?php
if (!defined('ROOT_PATH')){
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");
include_once  ROOT_PATH . "/controllers/stockItemController.php";
?>


<br>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text"><?php
                        $item = getStockItemByID(6);

                        echo "Naam: " . $item["StockItemName"] . "<br>";
                        echo "Prijs is: " . $item["UnitPrice"] . "<br>";
                        echo "Size is: " . $item["Size"] . "<br>";
                        ?></p>
                    <a href="#" class="btn btn-primary">Link</a>

                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">Card Example</p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">Card Example</p>
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
                    <p class="card-text">Card Example</p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">Card Example</p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">Card Example</p>
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
                    <p class="card-text">Card Example</p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">Card Example</p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">Card Example</p>
                    <a href="#" class="btn btn-primary">Link</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>