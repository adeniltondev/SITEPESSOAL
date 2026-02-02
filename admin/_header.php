<?php
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../includes/functions.php';
require_login();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel | <?= e($config['app_name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="bg-slate-950 text-slate-100">
<header class="border-b border-lime-400/20 bg-black/80">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
        <p class="text-lg font-bold text-lime-400">Painel Administrativo</p>
        <nav class="flex items-center gap-4 text-sm text-gray-300">
            <a class="hover:text-lime-400 transition" href="/admin/index.php">Dashboard</a>
            <a class="hover:text-lime-400 transition" href="/admin/projects.php">Projetos</a>
            <a class="hover:text-lime-400 transition" href="/admin/messages.php">Mensagens</a>
            <a class="hover:text-lime-400 transition" href="/admin/settings.php">Configurações</a>
            <a class="hover:text-lime-400 transition" href="/admin/logout.php">Sair</a>
        </nav>
    </div>
</header>
<main class="mx-auto max-w-6xl px-6 py-10">
