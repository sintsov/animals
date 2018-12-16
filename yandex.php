<?php
require __DIR__ . '/vendor/autoload.php';

use YandexCheckout\Client;

$client = new Client();
$client->setAuth('552512', 'test_zCg_En7t4fVc2aZDtBPoRWAzws9APEPZQ049XVaRhso');
$payment = $client->createPayment(
    array(
        'amount' => array(
            'value' => 300,
            'currency' => 'RUB',
        ),
        'confirmation' => array(
            'type' => 'redirect',
            'return_url' => 'https://rs.animals.dev.coolbeez.com/static/help/donate',
        ),
        'description' => 'Пожертвование с сайта',
    ),
    uniqid('', true)
);

header('Location: ' . $payment->confirmation->confirmation_url);
