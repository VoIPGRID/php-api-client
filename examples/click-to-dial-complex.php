<?php

require_once('../vendor/autoload.php');

use VoIPGRID\Call;
use VoIPGRID\CallConfig;
use VoIPGRID\User;

// Replace the username and password,
$user = new User('your username', 'your API token');

$clickToDial = new Call($user);

// The b_number is the number to be called.
// The b_cli is the cli to be sent to the b_number, make sure you own this number.
$config = new CallConfig([
    'b_number' => '01234567890',
    'b_cli' => '01209876543',
    'auto_answer' => true,
]);

$clickToDial->call($config);