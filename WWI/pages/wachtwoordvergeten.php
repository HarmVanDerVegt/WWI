<?php
if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include(ROOT_PATH . "/includes/header.php");

$csrf = filter_input(INPUT_GET, "csrf", FILTER_SANITIZE_STRING);

if($_SESSION["CSRF"] != $csrf){ ?>
    <meta http-equiv="refresh" content="=0;URL=error.php"/>
<?php } ?>

<html>
<body>
<div class="mx-auto" style="width: 36rem;">
    <h2>Wachtwoord vergeten</h2>
    <p>Vul hier je e-mailadres in, dan sturen wij u een link waarmee je een nieuw wachtwoord kan instellen.</p>
</div>
<div class="card mx-auto" style="width: 36rem;">
    <form method="get" action="send_link.php">
        <table>
            <tr>
                <td><label>E-mailadres:<font size="3" color="blue">*</font></label></td>
                <td><input type="email" name="email" placeholder="me@example.com" required><br><br></td>
            </tr>
            <tr>
                <td><label>E-mailadres herhalen:<font size="3" color="blue">*</font></label></td>
                <td><input type="email" name="emailControle" placeholder="me@example.com" required><br><br></td>
            </tr>
            <tr>
            <td></td>
            <td><p><font size="1.5">(</font><font size="1.5" color="blue">*</font><font size="1.5">) is verplicht</font></p></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit_email" value="Verander wachtwoord" class="btn btn-sample"></td>
            </tr>
        </table>
    </form>
</div>

<?php include(ROOT_PATH . "/includes/footer.php"); ?>
</body>
</html>


