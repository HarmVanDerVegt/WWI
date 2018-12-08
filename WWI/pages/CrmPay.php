<?php
/**
 * Created by PhpStorm.
 * User: lexkruiper97
 * Date: 29-11-2018
 * Time: 11:41
 */


$payment = $mollie->payments->get($payment->id);

if ($payment->isPaid()) {
    echo "Payment received.";
}


$payments = $mollie->payments->page();