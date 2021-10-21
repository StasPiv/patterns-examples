<?php

declare(strict_types = 1);

function loginViaFacebook(string $login, string $password) {
    // login here
    echo "Send HTTP API request to log in user $login with " .
        "password $password\n";
}

function sendPostViaFacebook() {
    // post here
    echo "Send HTTP API requests to create a post in Facebook timeline.\n";
}

function logoutViaFacebook(string $login) {
    // logout here
    echo "Send HTTP API request to log out user $login\n";
}


function sendPostViaLinkedin() {
    // post here
    echo "Send HTTP API requests to create a post in Linkedin timeline.\n";
}

function loginViaLinkedin(string $login, string $password) {
    // login here
    echo "Send HTTP API request to log in user $login with " .
        "password $password\n";
}

function logoutViaLinkedin(string $login) {
    // logout here
    echo "Send HTTP API request to log out user $login\n";
}

loginViaFacebook("john_smith", "******");
sendPostViaFacebook();
logoutViaFacebook("john_smith");

loginViaFacebook("john_smith", "******");
sendPostViaFacebook();
logoutViaFacebook("john_smith");

loginViaLinkedin("john_smith@example.com", "******");
sendPostViaLinkedin();
logoutViaLinkedin("john_smith@example.com");

loginViaLinkedin("john_smith@example.com", "******");
sendPostViaLinkedin();
logoutViaLinkedin("john_smith@example.com");