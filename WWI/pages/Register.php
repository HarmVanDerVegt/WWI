<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link href="\WWI\WWI\css\button.css" rel="stylesheet" type="text/css"/>
    <link href="\WWI\WWI\css\register.css" rel="stylesheet" type="text/css"/>


    <!-- voegt header toe -->
<?php include(ROOT_PATH . "/includes/header.php"); ?>
    <!-- start van reg form -->
    <div class="card mx-auto" style="width: 36rem;">
        <div class="card-body mx-auto">
            <div class="signup-form">
                <form method="post" action="confirmregister.php">
                    <p class="hint-text">Registreer voor een account.</p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6"><input type="text" class="form-control" name="Voornaam"
                                                         placeholder="Voornaam" required="required"></div>
                            <div class="col-xs-6"><input type="text" class="form-control" name="Achternaam"
                                                         placeholder="Achternaam" required="required"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-8"><input type="text" class="form-control" name="Straat"
                                                         placeholder="Straat" required="required"></div>
                            <div class="col-xs-4"><input type="text" class="form-control" name="Huisnummer"
                                                         placeholder="Nr." required="required"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="postcode" placeholder="Postcode"
                               required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="woonplaats" placeholder="Woonplaats"
                               required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="Provincie" placeholder="Provincie"
                               required="required">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="wachtwoord" placeholder="Wachtwoord"
                               required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="bevestig_wachtwoord"
                               placeholder="Bevestig Wachtwoord" required="required">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" name="Phone" placeholder="Telefoonnummer">
                    </div>
                    <div class="form-group">
                        <label class="checkbox-inline"><input type="checkbox" required="required"> Ik accepteer de <a
                                    href="../pages/Voorwaarden.php">Voorwaarden</a></label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sample btn-sample-success btn-block">Registreer nu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- start van reg form to array form -->
<?php
$Register = array();
$Register["Voornaam"] = filter_input(INPUT_POST, 'Voornaam');
$Register["Achternaam"] = filter_input(INPUT_POST, 'Achternaam');
$Register["Adres"] = filter_input(INPUT_POST, 'Adres');
$Register["Straat"] = filter_input(INPUT_POST, 'Straat');
$Register["Huisnummer"] = filter_input(INPUT_POST, 'Huisnummer');
$Register["Postcode"] = filter_input(INPUT_POST, 'postcode');
$Register["Woonplaats"] = filter_input(INPUT_POST, 'woonplaats');
$Register["Email"] = filter_input(INPUT_POST, 'email');
$Register["Wachtwoord"] = filter_input(INPUT_POST, 'wachtwoord');
$Register["bevestig_wachtwoord"] = filter_input(INPUT_POST, 'bevestig_wachtwoord');
$Register["Phone"] = filter_input(INPUT_POST, 'Phone');
$Register["Provincie"] = filter_input(INPUT_POST, 'Provincie');

if(!empty($Register["Voornaam"])){
if ($Register["Wachtwoord"] <> $Register["bevestig_wachtwoord"]) {
    echo("wachtwoorden zijn niet gelijk");
}
else {
    if (strlen($Register["Wachtwoord"]) < 7) {
        echo ("wachtwoord moet minimaal 7 kekens zijn");
    }
    else {
        InsertNewUser($Register);
    }   }}


    ?>


    <?php include(ROOT_PATH . "/includes/footer.php"); ?>