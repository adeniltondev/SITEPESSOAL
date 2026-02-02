<?php
// Conexão PDO com MySQL
$config = require __DIR__ . '/config.php';
date_default_timezone_set($config['timezone']);

$host = 'localhost';
$dbname = 'adeniltonmarketi_sitepssoal';
$user = 'adeniltonmarketi_sitepssoal';
$pass = 'nV0$F9@qK2oJgx^*';
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo 'Erro de conexão com o banco de dados.';
    exit;
}
