<!DOCTYPE html>
<head>
    <title>Contact</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
    include("../controllers/captchaController.php")

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="\WWI\WWI\css\bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <title>Contact</title>
    </head>
    <body>
        <!-- voegt header toe -->
        <?php include(ROOT_PATH . "/includes/header.php"); ?>
        <br>

        <!--Tabel die gegevens opvraagt-->

        <h3>Stuur ons een bericht</h3>
        <br>
        <table>
            <form action="\WWI\WWI\pages\contact.php" method="post" id="contactForm">
                <tr>
                    <td>Voornaam:</td>
                    <td><input type="text" id="voornaam" name="voornaam" placeholder="Voornaam" required></td>
                </tr>
                <tr>
                    <td>Achternaam:</td>
                    <td><input type="text" id="achternaam" name="achternaam" placeholder="Achternaam" required></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input type="email" id="email" name="email" placeholder="e-mail" required></td>
                </tr>
                <tr>
                    <td>Onderwerp:</td>
                    <td><input type="text" id="onderwerp" name="onderwerp" placeholder="onderwerp" required></td>
                </tr>
                <tr>
                    <td>Bericht:</td>
                    <td><textarea name="bericht" id="bericht" rows="4" placeholder="Bericht" required></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>        <div class="g-recaptcha"
                                     data-sitekey="6Lf2M3wUAAAAADEnVFqkSY71S3ML6Hc3-Oz7I-S7">

                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Verzenden!" class="btn btn-sample"></td>
                </tr>
            </form>
        </table>

        <br>
        <h3>Over ons</h3>
        <p>Wij zijn WWI. We zijn trots op onze producten en geloven in kwaliteit.<br>
        In ieder huis vindt een product van WWI zijn thuis.<br>
        Persoonlijk klantcontact staat bij ons hoog in het vaandel.<br>
        Wij zijn een importeur en groothandel die producten levert aan
        verschillende warenhuizen en supermarkten.<br>
            Time to market is voor Wide World Importers erg belangrijk.</p><br>
        <table>
        <tr>
            <td><b>contactgegevens</b></td>
        </tr>
        <tr>
            <td><b>Hoofdvestiging:</b></td>
            <td>Amsterdam</td>
        </tr>
        <tr>
            <td><b>email:</b></td>
            <td>contact.wideworldimporters@gmail.com</td>
        </tr>
        </table>
<!--        Mailfunctie-->
        <?php

        if (filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING) != NULL && filter_input(INPUT_POST, "submit", FILTER_SANITIZE_STRING) == TRUE) {
            mail("contact.wideworldimporters@gmail.com", filter_input(INPUT_POST, "onderwerp", FILTER_SANITIZE_STRING), filter_input(INPUT_POST, "bericht", FILTER_SANITIZE_STRING), "FROM: " . filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));
        }
            ?>
        <!-- voeg footer toe -->
        <br>
        <br>
        <?php include(ROOT_PATH . "/includes/footer.php"); ?>
    </body>
</html>
