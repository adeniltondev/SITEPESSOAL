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
<body class="bg-black text-white antialiased">
<header class="border-b border-lime-400/20 bg-black/80 backdrop-blur">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
        <a href="/" class="text-lg font-bold tracking-tight text-lime-400">
            <?= e($siteName) ?>
        </a>
        <nav class="hidden items-center gap-6 text-sm font-medium text-gray-300 md:flex">
            <a class="hover:text-lime-400 transition" href="/">Home</a>
            <a class="hover:text-lime-400 transition" href="/?page=sobre">Sobre</a>
            <a class="hover:text-lime-400 transition" href="/?page=servicos">Serviços</a>
            <a class="hover:text-lime-400 transition" href="/?page=projetos">Projetos</a>
            <a class="hover:text-lime-400 transition" href="/?page=contato">Contato</a>
        </nav>
        <div class="flex items-center gap-3">
            <a href="https://wa.me/5579988630142?text=Olá%20Gostaria%20de%20mais%20informações%20sobre%20seus%20serviços" target="_blank" rel="noopener" class="rounded-full border border-lime-400 px-4 py-2 text-sm font-semibold text-lime-400 hover:bg-lime-400 hover:text-black transition">
                <svg class="inline h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-4.767 1.18c-1.46.776-2.808 1.882-3.948 3.296-1.14 1.414-2.062 2.938-2.766 4.56-.704 1.62-1.232 3.292-1.55 4.945-.318 1.651-.313 3.304 0 4.937.313 1.633.933 3.16 1.842 4.52 1.908 2.719 4.832 4.482 8.15 4.482 1.34 0 2.655-.194 3.934-.575 2.604-.827 4.878-2.57 6.438-5.025 1.56-2.456 2.349-5.355 2.349-8.408 0-1.331-.102-2.66-.301-3.973-.199-1.312-.594-2.567-1.18-3.735-1.171-2.335-3.101-4.307-5.538-5.602-2.437-1.295-5.186-1.922-7.956-1.768zm7.957 1.768c.31.142.607.347.876.608.27.26.516.558.733.888.217.33.403.688.55 1.064.148.376.261.766.335 1.16.075.394.126.79.15 1.187.024.398.024.796 0 1.193-.024.398-.075.794-.15 1.188-.075.393-.187.783-.335 1.159-.146.375-.333.733-.55 1.063-.217.33-.463.628-.733.888-.269.261-.567.466-.876.608m-8.408 8.842c-.248.248-.381.58-.381.922 0 .342.133.674.381.922.248.248.58.381.922.381.342 0 .674-.133.922-.381.248-.248.381-.58.381-.922 0-.342-.133-.674-.381-.922-.248-.248-.58-.381-.922-.381-.342 0-.674.133-.922.381z"/></svg>
            </a>
            <a href="/?page=contato" class="rounded-full bg-lime-400 px-4 py-2 text-sm font-semibold text-black shadow hover:bg-lime-300 transition">Falar comigo</a>
        </div>
    </div>
    <div class="mx-auto flex max-w-6xl flex-wrap gap-3 px-6 pb-4 text-sm font-medium text-gray-400 md:hidden">
        <a class="hover:text-white" href="/">Home</a>
        <a class="hover:text-white" href="/?page=sobre">Sobre</a>
        <a class="hover:text-white" href="/?page=servicos">Serviços</a>
        <a class="hover:text-white" href="/?page=projetos">Projetos</a>
        <a class="hover:text-white" href="/?page=contato">Contato</a>
    </div>
</header>
<main>
