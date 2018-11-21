<?php
function verifyReCaptcha($captcha){
    $url = 'https://www.google.com/recaptcha/api/siteverify';

    $data = [
                'secret' => '6LcgLnwUAAAAAJU57bQETa1WfSdYiRPG_7NHmP -S',
                'response' => $captcha
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