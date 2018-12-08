<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
?>
<?php include(ROOT_PATH . "/includes/header.php"); ?>
    <head>
        <link href="\WWI\WWI\css\button.css" rel="stylesheet" type="text/css"/>
        <link href="\WWI\WWI\css\register.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
            function onSubmit(token) {
                document.getElementById("i-recaptcha").submit();
            }
        </script>
    </head>

<?php
//RACAPTCHA toevoegen
// Checked of de form is ingevuld
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response)
    {
        $fields_string = '';
        $fields = array(
            'secret' => '6LeBu34UAAAAAH_UVWbnUQlJ3AB-8bWQX9CYnats',
            'response' => $user_response
        );
        foreach ($fields as $key => $value)
            $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);


}
//EINDE RECAPTCHA
?>

    <!-- start van reg form -->
    <br>
    <div class="card mx-auto" style="width: 36rem;">
        <div class="card-body mx-auto">
            <div class="signup-form">
                <form method="post" id="i-recaptcha">
                    <p class="hint-text">Registreer voor een account.</p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6"><input type="text" class="form-control" name="Voornaam"
                                                         value="<?php if (!empty($_POST["Voornaam"])) {
                                                             echo $_POST["Voornaam"];
                                                         } ?>"
                                                         placeholder="Voornaam" required="required"></div>
                            <div class="col-xs-6"><input type="text" class="form-control" name="Achternaam"
                                                         value="<?php if (!empty($_POST["Achternaam"])) {
                                                             echo $_POST["Achternaam"];
                                                         } ?>"
                                                         placeholder="Achternaam" required="required"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-8"><input type="text" class="form-control" name="Straat"
                                                         value="<?php if (!empty($_POST["Straat"])) {
                                                             echo $_POST["Straat"];
                                                         } ?>"
                                                         placeholder="Straat" required="required"></div>
                            <div class="col-xs-4"><input type="text" class="form-control" name="Huisnummer"
                                                         value="<?php if (!empty($_POST["Huisnummer"])) {
                                                             echo $_POST["Huisnummer"];
                                                         } ?>"
                                                         placeholder="Nr." required="required"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="postcode" placeholder="Postcode"
                               value="<?php if (!empty($_POST["postcode"])) {
                                   echo $_POST["postcode"];
                               } ?>"
                               required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="woonplaats" placeholder="Woonplaats"
                               value="<?php if (!empty($_POST["woonplaats"])) {
                                   echo $_POST["woonplaats"];
                               } ?>"
                               required="required">
                    </div>
                    <div class="form-group">
                        <label for="sel1">Kies een provincie:</label>
                        <select class="form-control" name='Provincie' required="required" id="sel1">
                            <option value="Drenthe"> Drenthe</option>
                            <option value="Flevoland"> Flevoland</option>
                            <option value="Friesland"> Friesland</option>
                            <option value="Gelderland"> Gelderland</option>
                            <option value="Groningen"> Groningen</option>
                            <option value="Limburg"> Limburg</option>
                            <option value="Noord-Brabant"> Noord-Brabant</option>
                            <option value="Noord-Holland"> Noord-Holland</option>
                            <option value="Overijssel"> Overijssel</option>
                            <option value="Utrecht"> Utrecht</option>
                            <option value="Zeeland"> Zeeland</option>
                            <option value="Zuid-Holland"> Zuid-Holland</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required="required"
                               value="<?php if (!empty($_POST["email"])) {
                                   echo $_POST["email"];
                               } ?>">
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
                        <input type="tel" class="form-control" name="Phone" placeholder="Telefoonnummer"
                               value="<?php if (!empty($Register["Phone"])) {
                                   echo $Register["Phone"];
                               } ?>">
                    </div>
                    <div class="form-group">
                        <label class="checkbox-inline"><input type="checkbox" required="required"> Ik accepteer de <a
                                    href="../pages/Voorwaarden.php">Algemene Voorwaarden</a></label>
                    </div>
                    <!--recaptcha verwerken in de submit button-->
                    <div class="g-recaptcha"
                         data-sitekey="6LeBu34UAAAAAMS6VILfMPHn3i1-EHgC8FcSUfv6"
                         data-callback="onSubmit"
                         data-size="invisible">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sample btn-sample-success btn-block">Registreer nu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
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


if (!empty($Register["Voornaam"])) {
    if ($Register["Wachtwoord"] <> $Register["bevestig_wachtwoord"]) {
        echo("wachtwoorden zijn niet gelijk");
    } else {
        if (strlen($Register["Wachtwoord"]) < 7) {
            echo("wachtwoord te kort");
        } else {
            echo InsertNewUser($Register);

        }
    }
}


?>


<?php include(ROOT_PATH . "/includes/footer.php"); ?>