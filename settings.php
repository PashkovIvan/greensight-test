<?php
const PASSWORD_REPEAT_INPUT_NAME = "passwordRepeat";
const PASSWORD_INPUT_NAME = "password";
const EMAIL_INPUT_NAME = "email";
const LAST_NAME_INPUT_NAME = "lastName";
const FIRST_NAME_INPUT_NAME = "firstName";

const CSRF_TOKEN = "csrfToken";

session_start();

if (!isset($_SESSION[CSRF_TOKEN])) {
    $_SESSION[CSRF_TOKEN] = bin2hex(random_bytes(32));
}

function isAjaxRequest(): bool
{
    return
        !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
