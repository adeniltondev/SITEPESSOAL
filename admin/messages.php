<?php
session_start();
require __DIR__ . '/_header.php';

$stmt = $pdo->query('SELECT * FROM contatos ORDER BY criado_em DESC');
$messages = $stmt->fetchAll();
?>
<div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-white">Mensagens</h1>
</div>

<div class="mt-6 space-y-4">
    <?php if (empty($messages)): ?>
        <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 text-slate-400">Nenhuma mensagem recebida.</div>
    <?php endif; ?>
    <?php foreach ($messages as $msg): ?>
        <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-lg font-semibold text-white"><?= e($msg['nome']) ?></p>
                    <p class="text-sm text-slate-400"><?= e($msg['email']) ?> • <?= e($msg['telefone']) ?></p>
                </div>
                <a class="text-rose-300 hover:underline" href="/admin/delete.php?type=message&id=<?= e($msg['id']) ?>" onclick="return confirm('Excluir mensagem?');">Excluir</a>
            </div>
            <p class="mt-4 text-slate-300"><?= e($msg['mensagem']) ?></p>
        </div>
    <?php endforeach; ?>
</div>
<?php require __DIR__ . '/_footer.php'; ?>
