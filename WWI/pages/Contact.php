<!DOCTYPE html>
<head>
    <title>Contact</title>
    <meta charset="UTF-8">
    <link href="\WWI\WWI\css\bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        function onSubmit(token) {
            document.getElementById("i-recaptcha").submit();
        }
    </script>
</head>
<body>
<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

?>

<!-- voegt header toe -->
<?php include(ROOT_PATH . "/includes/header.php"); ?>
<br>
<!--Tabel die gegevens opvraagt-->

<h3>Stuur ons een bericht</h3>
<br>

<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6Ld1snwUAAAAAGmSnzS4R_rwtlxNulBSW1l8Z-zY',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
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
        // What happens when the reCAPTCHA is not properly set up
        echo 'reCAPTCHA error: Check to make sure your keys match the registered domain and are in the correct locations. You may also want to doublecheck your code for typos or syntax errors.';
    } else {
        // If CAPTCHA is successful...

        // Paste mail function or whatever else you want to happen here!
        echo '<br><p>CAPTCHA was completed successfully!</p><br>';
    }
} else { ?>
<form action="\WWI\WWI\pages\BerichtContact.php" method="post" id="i-recaptcha">
    <table>
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
            <td><button class="g-recaptcha btn btn-sample" data-sitekey="6Ld1snwUAAAAAGkYDP8K5vQOCsW4dn9DKW7dV43C" data-callback="onSubmit">
                    Verzenden
                </button></td>
        </tr>
    </table>
</form>
<?php } ?>
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
<!-- voeg footer toe -->
<br>
<br>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>
</body>
</html>