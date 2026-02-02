<?php
session_start();
require __DIR__ . '/_header.php';

$stmt = $pdo->query('SELECT * FROM projetos ORDER BY data_publicacao DESC');
$projects = $stmt->fetchAll();
?>
<div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-white">Projetos</h1>
    <a href="/admin/project_form.php" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900">Novo projeto</a>
</div>

<div class="mt-6 overflow-hidden rounded-2xl border border-slate-800">
    <table class="w-full text-sm">
        <thead class="bg-slate-900 text-left text-slate-300">
            <tr>
                <th class="px-4 py-3">Título</th>
                <th class="px-4 py-3">Categoria</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($projects)): ?>
            <tr>
                <td colspan="4" class="px-4 py-6 text-slate-400">Nenhum projeto cadastrado.</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($projects as $project): ?>
            <tr class="border-t border-slate-800">
                <td class="px-4 py-3 text-white"><?= e($project['titulo']) ?></td>
                <td class="px-4 py-3 text-slate-300"><?= e($project['categoria']) ?></td>
                <td class="px-4 py-3 text-slate-300"><?= e($project['status']) ?></td>
                <td class="px-4 py-3 text-slate-300">
                    <a class="text-white hover:underline" href="/admin/project_form.php?id=<?= e($project['id']) ?>">Editar</a>
                    <span class="mx-2 text-slate-600">|</span>
                    <a class="text-rose-300 hover:underline" href="/admin/delete.php?type=project&id=<?= e($project['id']) ?>" onclick="return confirm('Deseja remover este projeto?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/_footer.php'; ?>
