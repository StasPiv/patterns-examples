<?php

declare(strict_types = 1);

global $logFileHandle;
$logFileHandle = fopen('php://stdout', 'w');

global $config;
$config = [];

function logMessage(string $message) {
    global $logFileHandle;
    $date = date('Y-m-d');
    fwrite($logFileHandle, "$date: $message\n");
}

function setConfig(string $key, string $value) {
    global $config;

    $config[$key] = $value;
}

function getConfig(string $key) {
    global $config;

    return $config[$key];
}

/**
 * Клиентский код.
 */
logMessage("Started!");

$login = "test_login";
$password = "test_password";
setConfig("login", $login);
setConfig("password", $password);

if ($login == getConfig("login") &&
    $password == getConfig("password")
) {
    logMessage("Config singleton also works fine.");
}

logMessage("Finished!");