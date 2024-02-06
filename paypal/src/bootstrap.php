<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require '../vendor/autoload.php';

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = false;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
/*$paypalConfig = [
    'client_id' => 'AdPbpwginXxDfoTDrJZVMFMaVMNKBRJALY6JnbS0aihf-6fOqozhK2tl_KwgMJgkN3sObn1z2D6qa2yZ', //live
    //'client_id' => 'AalJYCIgFXleJe2ep60qhYodYsyECFp0Yi_j0LiQSX1cZDsGd61XnMBYEdIVokasQxhdfymkJfhMK_Y7', sand box
    'client_secret' => 'EJn4XXDy5x8l9N39qezz3VRTFWs7JpF7E9kE80llCzTIwcoZSpDANYFe5hsVTWlcntD1zAkYjXIsXlrc', // live
    //'client_secret' => 'ENKx3c11Ju7nxOG-rZqEJcNCUAzyPTVZukXrqdGQuOEureeaiBWyRv1arm7hrIYtZVLKxJu-xwlKGl9D',sand box
    'return_url' => 'http://localhost/test/paypal-rest-api-example-master/src/response.php',
    'cancel_url' => 'http://localhost/test/paypal-rest-api-example-master/src/payment-cancelled.html'
];*/

$paypalConfig = [
    'client_id' => 'ATF57NwV_zB_RnbjhXkd5iKxhcd0UA4sOKJjkOpgPi7RNN-6Tkzk1xr5bt1LoEf5tAgJqDutJEQbFXvQ', 
    'client_secret' => 'EIhyS9z8fCQd9TMlgaWG3m0BgXnyfL8xIflCIp2FzkzShPT7lkYeLGhvEBmyWlYfx4LpC9LKyuQoKwt5',
    'return_url' => 'http://localhost/test/paypal/src/response.php',
    'cancel_url' => 'http://localhost/test/paypal/src/payment-cancelled.html'
];
// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'name' => 'paypal_money'
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}
