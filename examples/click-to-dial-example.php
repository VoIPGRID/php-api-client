<?php

require_once('../vendor/autoload.php');

use VoIPGRID\Dial;
use VoIPGRID\User;

// Replace the username and password,
$user = new User('your username', 'your API token');
$clickToDial = new Dial($user);

// Replace this number with a number you want to call.
$clickToDial->callNumber('01234567890');