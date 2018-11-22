$(document).ready(function () {
    var contactForm = $("#contactForm");

    contactForm.on("submit", function (e) {
        e.PreventDefault();

        var voornaam = $("#voornaam").val();
        var achternaam = $("#achternaam").val();
        var email = $("#email").val();
        var onderwerp = $("#onderwerp").val();
        var bericht = $("#bericht").val();

        $.ajax({
            type: "POST",
            url: "Contact.php",
            data: {
                action: "verifyCaptcha",
                voornaam: voornaam,
                achternaam: achternaam,
                email: email,
                onderwerp: onderwerp,
                bericht: bericht,
                captcha: grecaptcha.GetResponse()
            }
        })
    });
});