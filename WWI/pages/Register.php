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
            'secret' => '6Ld1snwUAAAAAGmSnzS4R_rwtlxNulBSW1l8Z-zY',
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

    if (!$res['success']) {
        echo 'reCAPTCHA error';
    }
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
                                    href="../pages/Voorwaarden.php">Algemene Voorwaarden</a></label>
                    </div>
                    <!--recaptcha verwerken in de submit button-->
                    <div class="g-recaptcha"
                         data-sitekey="6Ld1snwUAAAAAGkYDP8K5vQOCsW4dn9DKW7dV43C"
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