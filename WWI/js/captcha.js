var $ = require('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');

function captcha(){

    var contactFrom = $("contactForm")

    $.ajax({
        type: "POST",
        url: "Contact.php",
        data: {
            voornaam: voornaam,
            achternaam: achternaam,
            email: email,
            onderwerp: onderwerp,
            bericht: bericht,
            captcha: grecaptcha.getResponse()
        }
    })
}