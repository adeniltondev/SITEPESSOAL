<?php
// Header padrão
if (!isset($pageTitle)) {
    $pageTitle = 'Home';
}
$siteName = $config['app_name'] ?? 'Site Profissional';
$baseUrl = get_base_url($config);
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?> | <?= e($siteName) ?></title>
    <meta name="description" content="Gestão de marketing, tecnologia, CRM e desenvolvimento de sites e sistemas.">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⚡</text></svg>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
<header class="border-b border-slate-800/80 bg-slate-950/80 backdrop-blur">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
        <a href="/" class="text-lg font-semibold tracking-tight text-white">
            <?= e($siteName) ?>
        </a>
        <nav class="hidden items-center gap-6 text-sm font-medium text-slate-300 md:flex">
            <a class="hover:text-white" href="/">Home</a>
            <a class="hover:text-white" href="/?page=sobre">Sobre</a>
            <a class="hover:text-white" href="/?page=servicos">Serviços</a>
            <a class="hover:text-white" href="/?page=projetos">Projetos</a>
            <a class="hover:text-white" href="/?page=contato">Contato</a>
        </nav>
        <a href="/?page=contato" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow hover:bg-slate-200">Falar comigo</a>
    </div>
    <div class="mx-auto flex max-w-6xl flex-wrap gap-3 px-6 pb-4 text-sm font-medium text-slate-300 md:hidden">
        <a class="hover:text-white" href="/">Home</a>
        <a class="hover:text-white" href="/?page=sobre">Sobre</a>
        <a class="hover:text-white" href="/?page=servicos">Serviços</a>
        <a class="hover:text-white" href="/?page=projetos">Projetos</a>
        <a class="hover:text-white" href="/?page=contato">Contato</a>
    </div>
</header>
<main>
