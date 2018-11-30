<?php
/**
 * Created by PhpStorm.
 * User: lexkruiper97
 * Date: 29-11-2018
 * Time: 11:00
 */

if (!defined('ROOT_PATH')) {
    include("../config.php");
}

include_once ROOT_PATH . "/controllers/Payment/vendor/autoload.php";



$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_hxu2rAAxCECgD3DNeNnVG9jzJWhMtg");

$payment = $mollie->payments->create([
    "amount" => [
        "currency" => "EUR",
        "value" => "10.00"
    ],
    "description" => "Payment TST",
    "redirectUrl" => "ges/Confirm%20payment.php",
    "webhookUrl"  => "https://webshop.example.org/mollie-webhook/",
    "method"      => "ideal"
]);

$payment->id;

$payment->getCheckoutUrl();

header("Location: " . $payment->getCheckoutUrl(), true, 303);

