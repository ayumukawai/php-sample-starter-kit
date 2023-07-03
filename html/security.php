<?php

// XSS対策
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// CSRF対策
function create_token()
{
    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
}

function validate_token()
{
    if (
        empty($_SESSION['token']) ||
        $_SESSION['token'] !== $_POST['token']
    ) {
        exit('そのリクエストは無効です。');
    }
}

session_start();
