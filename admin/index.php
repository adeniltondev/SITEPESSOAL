<?php
session_start();
require __DIR__ . '/_header.php';

$projectsCount = $pdo->query('SELECT COUNT(*) FROM projetos')->fetchColumn();
$messagesCount = $pdo->query('SELECT COUNT(*) FROM contatos')->fetchColumn();
$publishedCount = $pdo->query("SELECT COUNT(*) FROM projetos WHERE status = 'publicado'")->fetchColumn();
?>
<div class="grid gap-6 md:grid-cols-3">
    <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6">
        <p class="text-sm text-slate-400">Projetos cadastrados</p>
        <p class="mt-2 text-3xl font-semibold text-white"><?= e((string) $projectsCount) ?></p>
    </div>
    <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6">
        <p class="text-sm text-slate-400">Projetos publicados</p>
        <p class="mt-2 text-3xl font-semibold text-white"><?= e((string) $publishedCount) ?></p>
    </div>
    <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6">
        <p class="text-sm text-slate-400">Mensagens recebidas</p>
        <p class="mt-2 text-3xl font-semibold text-white"><?= e((string) $messagesCount) ?></p>
    </div>
</div>
<?php require __DIR__ . '/_footer.php'; ?>
