<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
include_once ROOT_PATH . "/controllers/userController.php";

?>

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
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck">
                        <label class="form-check-label" for="dropdownCheck">
                            <div class="text-white">  Onthoud mij </div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-sample btn-sample-success">Log in</button>
                </form>
                <div class="dropdown-divider"></div>
                <a href="/WWI/WWI/pages/Register.php" class="dropdown-item" href="#">Nieuw hier? Registreren</a>
                <a class="dropdown-item" href="#">Wachtwoord vergeten?</a>
            </div>

        </li>
    </ul>
</div>