<?php

require_once "vendor/autoload.php";

use BetterAuthing\Auth\AuthClient;
use BetterAuthing\Entity\Options;

$options = new Options();
$client = new AuthClient($options);