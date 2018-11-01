<head>
    <link href="\WWI\WWI\css\bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!--    <link href="\WWI\WWI\css\navbar.css" rel="stylesheet" type="text/css"/>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/popper.js"></script>
    <script src='\WWI\WWI\js\bootstrap.bundle.min.js'></script>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">WWI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- dropdown category -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                    Dropdown
                </a>
                <div class="dropdown-menu">
                    <?php
                    include_once "../config.php";
                    include_once ROOT_PATH . "/controllers/stockGroupsController.php";
                    $categorynavbarar = getAllStockGroups();
                    foreach ($categorynavbarar as $categorynavbar) {
                        //print ("<a class=\"dropdown-item\" href=\"#\">" . $categorynavbar["StockGroupName"] . "</a>");
                        //print $categorynavbar;
                        echo "<a class=\"dropdown-item\" href=\"#\">" . $categorynavbar["StockGroupName"] . "</a> \n";
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
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                    Login
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"></a>
                    <form class="px-4 py-3">
                        <div class="form-group">
                            <label for="exampleDropdownFormEmail1">Email adres</label>
                            <input type="email" class="form-control" id="FormEmail"
                                   placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleDropdownFormPassword1">Password</label>
                            <input type="password" class="form-control" id="FormPassword"
                                   placeholder="Wachtwoord">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dropdownCheck">
                            <label class="form-check-label" for="dropdownCheck">
                                Onthoud mij
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Nieuw hier? Registreren</a>
                    <a class="dropdown-item" href="#">Wachtwoord vergeten?</a>
                </div>

            </li>
        </ul>
    </div>
    <!-- einde login -->
    <!-- zoekveld -->
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoeken</button>
    </form>
    <!-- einde zoekveld -->

</nav>