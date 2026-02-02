<?php
session_start();
require __DIR__ . '/_header.php';

$id = $_GET['id'] ?? null;
$editing = $id !== null;
$errors = [];

$project = [
    'titulo' => '',
    'categoria' => '',
    'descricao' => '',
    'cliente' => '',
    'ano' => '',
    'url' => '',
    'status' => 'rascunho',
];

if ($editing) {
    $stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $project = $stmt->fetch();
    if (!$project) {
        redirect('/admin/projects.php');
    }
}

if (is_post()) {
    $project['titulo'] = trim($_POST['titulo'] ?? '');
    $project['categoria'] = trim($_POST['categoria'] ?? '');
    $project['descricao'] = trim($_POST['descricao'] ?? '');
    $project['cliente'] = trim($_POST['cliente'] ?? '');
    $project['ano'] = trim($_POST['ano'] ?? '');
    $project['url'] = trim($_POST['url'] ?? '');
    $project['status'] = $_POST['status'] ?? 'rascunho';

    if ($project['titulo'] === '') {
        $errors['titulo'] = 'Informe o título.';
    }
    if ($project['categoria'] === '') {
        $errors['categoria'] = 'Informe a categoria.';
    }
    if ($project['descricao'] === '') {
        $errors['descricao'] = 'Informe a descrição.';
    }

    if (empty($errors)) {
        if ($editing) {
            $stmt = $pdo->prepare('UPDATE projetos SET titulo = :titulo, categoria = :categoria, descricao = :descricao, cliente = :cliente, ano = :ano, url = :url, status = :status WHERE id = :id');
            $stmt->execute([
                ':titulo' => $project['titulo'],
                ':categoria' => $project['categoria'],
                ':descricao' => $project['descricao'],
                ':cliente' => $project['cliente'],
                ':ano' => $project['ano'],
                ':url' => $project['url'],
                ':status' => $project['status'],
                ':id' => $id,
            ]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO projetos (titulo, categoria, descricao, cliente, ano, url, status, data_publicacao) VALUES (:titulo, :categoria, :descricao, :cliente, :ano, :url, :status, NOW())');
            $stmt->execute([
                ':titulo' => $project['titulo'],
                ':categoria' => $project['categoria'],
                ':descricao' => $project['descricao'],
                ':cliente' => $project['cliente'],
                ':ano' => $project['ano'],
                ':url' => $project['url'],
                ':status' => $project['status'],
            ]);
            $id = $pdo->lastInsertId();
            $editing = true;
        }

        // Upload de imagens
        if (!empty($_FILES['imagens']['name'][0])) {
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
            foreach ($_FILES['imagens']['tmp_name'] as $index => $tmpName) {
                if ($tmpName === '') {
                    continue;
                }
                $mime = mime_content_type($tmpName);
                if (!allowed_upload($mime, $allowed)) {
                    continue;
                }
                $ext = pathinfo($_FILES['imagens']['name'][$index], PATHINFO_EXTENSION);
                $filename = slugify($project['titulo']) . '-' . uniqid() . '.' . $ext;
                $destination = $config['upload_dir'] . '/' . $filename;
                if (move_uploaded_file($tmpName, $destination)) {
                    $path = $config['upload_url'] . '/' . $filename;
                    $stmt = $pdo->prepare('INSERT INTO midias_projeto (projeto_id, type, path, criado_em) VALUES (:projeto_id, :type, :path, NOW())');
                    $stmt->execute([
                        ':projeto_id' => $id,
                        ':type' => 'image',
                        ':path' => $path,
                    ]);
                }
            }
        }

        // Upload de vídeo
        if (!empty($_FILES['video']['tmp_name'])) {
            $mime = mime_content_type($_FILES['video']['tmp_name']);
            $allowedVideo = ['video/mp4', 'video/quicktime'];
            if (allowed_upload($mime, $allowedVideo)) {
                $ext = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
                $filename = slugify($project['titulo']) . '-' . uniqid() . '.' . $ext;
                $destination = $config['upload_dir'] . '/' . $filename;
                if (move_uploaded_file($_FILES['video']['tmp_name'], $destination)) {
                    $path = $config['upload_url'] . '/' . $filename;
                    $stmt = $pdo->prepare('INSERT INTO midias_projeto (projeto_id, type, path, criado_em) VALUES (:projeto_id, :type, :path, NOW())');
                    $stmt->execute([
                        ':projeto_id' => $id,
                        ':type' => 'video',
                        ':path' => $path,
                    ]);
                }
            }
        }

        redirect('/admin/projects.php');
    }
}

$mediaStmt = $editing ? $pdo->prepare('SELECT * FROM midias_projeto WHERE projeto_id = :id') : null;
$media = [];
if ($mediaStmt) {
    $mediaStmt->execute([':id' => $id]);
    $media = $mediaStmt->fetchAll();
}
?>
<div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-white"><?= $editing ? 'Editar projeto' : 'Novo projeto' ?></h1>
    <a href="/admin/projects.php" class="text-sm text-slate-300 hover:text-white">Voltar</a>
</div>

<form method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="text-sm font-semibold text-slate-200">Título</label>
            <input name="titulo" value="<?= e($project['titulo']) ?>" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" required>
            <?php if (isset($errors['titulo'])): ?>
                <p class="mt-1 text-xs text-rose-300"><?= e($errors['titulo']) ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-200">Categoria</label>
            <input name="categoria" value="<?= e($project['categoria']) ?>" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" required>
            <?php if (isset($errors['categoria'])): ?>
                <p class="mt-1 text-xs text-rose-300"><?= e($errors['categoria']) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-200">Descrição</label>
        <textarea name="descricao" class="mt-2 h-32 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" required><?= e($project['descricao']) ?></textarea>
        <?php if (isset($errors['descricao'])): ?>
            <p class="mt-1 text-xs text-rose-300"><?= e($errors['descricao']) ?></p>
        <?php endif; ?>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <div>
            <label class="text-sm font-semibold text-slate-200">Cliente</label>
            <input name="cliente" value="<?= e($project['cliente']) ?>" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-200">Ano</label>
            <input name="ano" value="<?= e($project['ano']) ?>" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-200">URL</label>
            <input name="url" value="<?= e($project['url']) ?>" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" placeholder="https://">
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="text-sm font-semibold text-slate-200">Status</label>
            <select name="status" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200">
                <option value="rascunho" <?= $project['status'] === 'rascunho' ? 'selected' : '' ?>>Rascunho</option>
                <option value="publicado" <?= $project['status'] === 'publicado' ? 'selected' : '' ?>>Publicado</option>
            </select>
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-200">Imagens (JPG, PNG, WEBP)</label>
            <input name="imagens[]" type="file" multiple accept="image/*" class="mt-2 w-full text-sm text-slate-300">
        </div>
    </div>

    <div>
        <label class="text-sm font-semibold text-slate-200">Vídeo (MP4)</label>
        <input name="video" type="file" accept="video/mp4,video/quicktime" class="mt-2 w-full text-sm text-slate-300">
    </div>

    <?php if (!empty($media)): ?>
        <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6">
            <p class="text-sm font-semibold text-slate-200">Mídias cadastradas</p>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <?php foreach ($media as $item): ?>
                    <div class="rounded-xl border border-slate-800 bg-slate-900 p-3">
                        <?php if ($item['type'] === 'image'): ?>
                            <img src="<?= e($item['path']) ?>" alt="Mídia" class="h-32 w-full rounded-lg object-cover">
                        <?php else: ?>
                            <video controls class="h-32 w-full rounded-lg">
                                <source src="<?= e($item['path']) ?>" type="video/mp4">
                            </video>
                        <?php endif; ?>
                        <a class="mt-2 inline-block text-xs text-rose-300" href="/admin/delete.php?type=media&id=<?= e($item['id']) ?>&project_id=<?= e($id) ?>" onclick="return confirm('Remover mídia?');">Remover</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <button type="submit" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-900">Salvar</button>
</form>
<?php require __DIR__ . '/_footer.php'; ?>
