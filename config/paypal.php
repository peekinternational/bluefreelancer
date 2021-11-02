<?php
/**
 * PayPal Setting & API Credentials
 * Created by Belal Ahmet (bilal.ahmed916@outlook.com).
 */

return [
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => env('sb-5430vu8141849_api1.business.example.com', ''),
        'password'    => env('97XC6RDRZN6VJRBW', ''),
        'secret'      => env('A9A0gZTWcGyirG.qnLuzNtP0Yj-IAxLuJDJ1WtJb9yb.BI6d8m8jF01a', ''),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id'      => 'APP-80W284485P519543T', // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', ''),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', ''),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => '', // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'USD',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => false, // Validate SSL when creating api client.
];
