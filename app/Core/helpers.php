<?php

function e(?string $value): string
{
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}


function redirect(string $path): void
{
    header("Location: {$path}");
    exit;
}


function query_string(array $params = []): string
{
    $current = $_GET;

    foreach ($params as $key => $value) {
        $current[$key] = $value;
    }

    return http_build_query($current);
}


// Flash message
function flash_set(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}


function flash_get(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];

    unset($_SESSION['flash']);

    return $flash;
}


function view(string $path, array $data = []): void
{
    extract($data);

    require __DIR__ . '/../Views/' . $path . '.php';
}