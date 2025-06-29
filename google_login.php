<?php
session_start();
require_once 'config/social_login.php';

$state = generateState();
storeState($state);

$params = [
    'client_id' => GOOGLE_CLIENT_ID,
    'redirect_uri' => GOOGLE_REDIRECT_URI,
    'response_type' => 'code',
    'scope' => 'openid email profile',
    'state' => $state,
    'access_type' => 'offline'
];

$url = GOOGLE_AUTH_URL . '?' . http_build_query($params);

// Log the generated state to a file
file_put_contents(__DIR__ . '/state_debug.log', date('Y-m-d H:i:s') . " | google_login.php | Generated state: $state\n", FILE_APPEND);

header('Location: ' . $url);
exit(); 