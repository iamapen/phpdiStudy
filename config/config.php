<?php
declare(strict_types=1);

use Psr\Log\LogLevel;

require __DIR__.'/../vendor/autoload.php';

$logLevel = LogLevel::DEBUG;
$logDir = realpath(__DIR__.'/../tmp/logs');

return [
    'config.log.logLevel' => $logLevel,
    'config.log.logDir' => $logDir,
    'config.log.maxDays' => 10,
];
