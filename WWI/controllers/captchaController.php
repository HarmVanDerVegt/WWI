<?php

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'verifyCaptcha' : verifyReCaptcha();
            break;
    }
}

function verifyReCaptcha(){
    $url = 'https://www.google.com/recaptcha/api/siteverify';

    $data = [
        'secret' => '6LcgLnwUAAAAAJU57bQETa1WfSdYiRPG_7NHmP -S',
        'response' => $_POST["captcha"]
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_succes = json_decode($verify);

    return $captcha_succes->succes;
}