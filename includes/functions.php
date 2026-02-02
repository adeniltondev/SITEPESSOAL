<?php
// Funções utilitárias
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function is_post(): bool {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

function get_base_url(array $config): string {
    return rtrim($config['base_url'], '/');
}

function require_login(): void {
    if (empty($_SESSION['user_id'])) {
        redirect('/admin/login.php');
    }
}

function slugify(string $text): string {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower($text ?: 'n-a');
}

function allowed_upload(string $mime, array $allowed): bool {
    return in_array($mime, $allowed, true);
}
