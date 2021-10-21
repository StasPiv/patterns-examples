<?php

declare(strict_types = 1);

function sendNotificationViaSlack(string $login, string $apiKey, string $chatId, string $message) {
    // Send authentication request to Slack web service.
    echo "Logged in to a slack account '{$login}'.\n";

    // Send message post request to Slack web service.
    echo "Posted following message into the '$chatId' chat: '$message'.\n";
}

function sendNotificationViaEmail(string $adminEmail, string $title, string $message) {
    echo "Sent email with title '$title' to '{$adminEmail}' that says '$message'.";
}

$message = "<strong style='color:red;font-size: 50px;'>Alert!</strong> " .
    "Our website is not responding. Call admins and bring it up!";
$title = "Website is down!";

sendNotificationViaEmail("developers@example.com", $title, $message);
echo "\n\n";

sendNotificationViaSlack("example.com", "XXXXXXXX", "Example.com Developers", $message);
