<?php
session_start();
$config = require __DIR__ . '/config/config.php';
require __DIR__ . '/config/db.php';
require __DIR__ . '/includes/functions.php';

$page = $_GET['page'] ?? 'home';
$allowed = ['home', 'sobre', 'servicos', 'projetos', 'contato'];

if (!in_array($page, $allowed, true)) {
    http_response_code(404);
    $page = 'home';
}

$pageTitle = ucfirst($page);
require __DIR__ . '/includes/header.php';
require __DIR__ . '/pages/' . $page . '.php';
require __DIR__ . '/includes/footer.php';
