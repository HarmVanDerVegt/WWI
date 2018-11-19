<!DOCTYPE html>

<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="\WWI\css\bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <!-- voegt header toe -->
        <?php include(ROOT_PATH . "/includes/header.php"); ?>
        <br>
        <table>
            <form action="/WWI/pages/Contact.php" method="post">
                <tr>
                    <td>Voornaam:</td>
                    <td><input type="text" name="voornaam" placeholder="Voornaam"></td>
                </tr>
                <tr>
                    <td>Achternaam:</td>
                    <td><input type="text" name="achternaam" placeholder="Achternaam"></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input type="email" name="email" value="Lex_De@T-Rex.nl" placeholder="E-mail" required></td>
                </tr>
                <tr>
                    <td>Bericht:</td>
                    <td><textarea name="bericht" rows="4" placeholder="Bericht" required>bericht</textarea></td>
                </tr>
                <tr>
                    <td>Verzenden:</td>
                    <td><input type="submit" value="verzenden!"></td>
                </tr>
            </form>
        </table>

        <?php
        $i = 0;
//if(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING) != NULL && filter_input(INPUT_POST, "submit", FILTER_SANITIZE_STRING) == TRUE){
        //  $i++;
        mail("contact.wideworldimporters@gmail.com", $i, filter_input(INPUT_POST, "bericht", FILTER_SANITIZE_STRING), "FROM: " . filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));
//}
        ?>
        <!-- voeg footer toe -->
        <br>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>
    </body>
</html>
