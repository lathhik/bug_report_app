<?php

declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

use App\Helpers\App;
use App\Helpers\Config;
use App\Logger\Logger;
use App\Logger\LogLevel;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Src/Exception/exception.php';

header('Content-Type:text/plain', true);

$logger = new Logger;
// $logger->log(LogLevel::EMERGENCY, 'This in an emergency log', ['exception' => 'emergency']);
// $logger->info('User created successfully', ['id' => 232]);
