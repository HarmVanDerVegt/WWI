<head>
    <link href="\WWI\WWI\css\bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="\WWI\WWI\css\navbar.css" rel="stylesheet" type="text/css"/>
    <link href="\WWI\WWI\css\button.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/popper.js"></script>
    <script src='\WWI\WWI\js\bootstrap.bundle.min.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a href="/WWI/WWI/pages/index.php"><img class="img-thumbnail" src="/WWI/WWI/pages/media/wwi-ls.png" height="250px"
                                             width="90px"/>
        <!--<a class="navbar-brand" href="#">WWI</a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- dropdown category -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown">
                        Categorie
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <?php
                        //include_once "../config.php";
                        include_once ROOT_PATH . "/controllers/stockGroupsController.php";
                        $categorynavbarar = getAllStockGroups();
                        foreach ($categorynavbarar as $categorynavbar) {
                            $link = "<a class=\"dropdown-item\"
                            href=\"/WWI/WWI/pages/category/product_lijst.php?category="
                                . $categorynavbar["StockGroupName"] . "\">"
                                . $categorynavbar["StockGroupName"] . "</a>";
                            echo $link;
                        }
                        ?>
                    </div>
                </li>
            </ul>
        </div>
        <!-- einde dropdown category -->
        <!-- login -->
        <div class="navbar-right" id="navbarSupportedContent">
            <ul class="navbar-nav">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown">
                        Login
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"></a>

                        <form class="px-4 py-3" method="post" action="../pages/login.php">
                            <div class="form-group">
                                <div class="text-white">Email adres</div>
                                <input type="email" class="form-control" id="FormEmail" name="username"
                                       placeholder="email@example.com">
                            </div>
                            <div class="form-group">
                                <div class="text-white">Password</div>
                                <input type="password" class="form-control" id="FormPassword" name="password"
                                       placeholder="Wachtwoord">
                            </div>

                            <button type="submit" class="btn btn-sample btn-sample-success">Log in</button>
                        </form>
                        <div class="dropdown-divider"></div>
                        <a href="/WWI/WWI/pages/Register.php" class="dropdown-item" href="#">Nieuw hier? Registreren</a>
                        <a class="dropdown-item" href="/WWI/WWI/pages/wachtwoordvergeten.php">Wachtwoord vergeten?</a>
                    </div>

                </li>
            </ul>
        </div>
        <!-- einde login -->
        <!-- zoekveld -->
        <form class="form-inline my-2 my-lg-0" action="/WWI/WWI/pages/Search.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search" name="Zoeken"
                   id="Zoeken">
            <button class="btn btn-sample btn-sample-success" type="submit">Zoeken <i class="fa fa-search"></i>
            </button>

        </form>
        <form class="form-inline my-2 my-lg-0" action="/WWI/WWI/pages/ShoppingCart.php">
            <button class="btn btn-sample btn-sample-success" type="submit">Winkelwagen <i
                        class="fa fa-shopping-cart"></i></button>
        </form>
        <form class="form-inline my-2 my-lg-0" action="/WWI/WWI/pages/Contact.php">
            <button class="btn btn-sample btn-sample-success" type="submit">Contact</button>
        </form>

        <!-- einde zoekveld -->

</nav>