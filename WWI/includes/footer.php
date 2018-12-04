
<head>
    <meta charset="UTF-8">
    <link href="\WWI\WWI\css\footer.css" rel="stylesheet" type="text/css"/>
    <title></title>
</head>
<!-- Footer -->
<footer class="page-footer font-small bg-light">

    <div class="footer-custom">
        <div class="container" class="footer-custom">

            <div class="text-center py-3 text-white">
                <a href="/WWI/WWI/pages/Voorwaarden.php">Voorwaarden</a>
                <a href="/WWI/WWI/pages/Contact.php">Contact</a>
                <?php

                if ($_SESSION['IsSystemUser'] == 0){echo ('<a href=\'/WWI/WWI/pages/Register.php\'>Registreren</a>');}
                if ($_SESSION['IsSystemUser'] == 1){echo ('<a href=\'/WWI/WWI/pages/welcome.php\'>Mijn WWI</a>');}
                if ($_SESSION['IsEmployee'] == 1){echo ('<a href=\'/WWI/WWI/pages/beheer.php\'> Beheer</a>');}
                ?>  </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2018 Copyright: Wide World Importers
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->