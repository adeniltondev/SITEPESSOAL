<?php
// Projetos
$category = $_GET['categoria'] ?? '';
$params = [];
$sql = "SELECT p.*, m.id AS media_id, m.type AS media_type, m.path AS media_path
        FROM projetos p
        LEFT JOIN midias_projeto m ON m.projeto_id = p.id
        WHERE p.status = 'publicado'";

if ($category !== '') {
    $sql .= " AND p.categoria = :categoria";
    $params[':categoria'] = $category;
}

$sql .= " ORDER BY p.data_publicacao DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();

$projects = [];
foreach ($rows as $row) {
    $id = $row['id'];
    if (!isset($projects[$id])) {
        $projects[$id] = [
            'id' => $row['id'],
            'titulo' => $row['titulo'],
            'categoria' => $row['categoria'],
            'descricao' => $row['descricao'],
            'cliente' => $row['cliente'],
            'ano' => $row['ano'],
            'url' => $row['url'],
            'midias' => [],
        ];
    }
    if ($row['media_id']) {
        $projects[$id]['midias'][] = [
            'type' => $row['media_type'],
            'path' => $row['media_path'],
        ];
    }
}

$catStmt = $pdo->query("SELECT DISTINCT categoria FROM projetos WHERE status = 'publicado' ORDER BY categoria ASC");
$categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);
?>
<section class="fade-in">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Projetos</p>
                <h1 class="mt-4 text-4xl font-semibold text-white">Portfólio de projetos e entregas</h1>
                <p class="mt-4 text-lg text-slate-300">Resultados em marketing, CRM, sites e sistemas.</p>
            </div>
            <form method="get" class="flex items-center gap-3">
                <input type="hidden" name="page" value="projetos">
                <select name="categoria" class="rounded-xl border border-slate-800 bg-slate-950 px-4 py-2 text-sm text-slate-200">
                    <option value="">Todas as categorias</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= e($cat) ?>" <?= $cat === $category ? 'selected' : '' ?>><?= e($cat) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900">Filtrar</button>
            </form>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php if (empty($projects)): ?>
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 text-slate-400">Nenhum projeto publicado ainda.</div>
            <?php endif; ?>
            <?php foreach ($projects as $project): ?>
                <?php
                $cover = $project['midias'][0]['path'] ?? '';
                ?>
                <div class="card-hover rounded-2xl border border-slate-800 bg-slate-950 p-6">
                    <div class="flex h-40 items-center justify-center rounded-xl bg-slate-900 text-slate-400">
                        <?php if ($cover): ?>
                            <img src="<?= e($cover) ?>" alt="<?= e($project['titulo']) ?>" class="h-full w-full rounded-xl object-cover">
                        <?php else: ?>
                            <span>Sem mídia</span>
                        <?php endif; ?>
                    </div>
                    <p class="mt-4 text-sm font-semibold uppercase tracking-[0.2em] text-slate-400"><?= e($project['categoria']) ?></p>
                    <h3 class="mt-2 text-lg font-semibold text-white"><?= e($project['titulo']) ?></h3>
                    <p class="mt-2 text-sm text-slate-400 line-clamp-3"><?= e($project['descricao']) ?></p>
                    <button data-modal-open="modal-<?= $project['id'] ?>" class="mt-4 text-sm font-semibold text-white">Ver detalhes</button>
                </div>

                <div id="modal-<?= $project['id'] ?>" class="modal fixed inset-0 z-50 items-center justify-center bg-black/70 px-6">
                    <div class="w-full max-w-3xl rounded-2xl border border-slate-800 bg-slate-950 p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400"><?= e($project['categoria']) ?></p>
                                <h3 class="mt-2 text-2xl font-semibold text-white"><?= e($project['titulo']) ?></h3>
                            </div>
                            <button data-modal-close class="rounded-full border border-slate-700 px-3 py-1 text-sm text-slate-300">Fechar</button>
                        </div>
                        <p class="mt-4 text-slate-300"><?= e($project['descricao']) ?></p>
                        <div class="mt-4 grid gap-4 md:grid-cols-2">
                            <?php foreach ($project['midias'] as $media): ?>
                                <?php if ($media['type'] === 'image'): ?>
                                    <img src="<?= e($media['path']) ?>" alt="<?= e($project['titulo']) ?>" class="h-48 w-full rounded-xl object-cover">
                                <?php else: ?>
                                    <video controls class="h-48 w-full rounded-xl">
                                        <source src="<?= e($media['path']) ?>" type="video/mp4">
                                    </video>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-4 text-sm text-slate-400">
                            <p><strong class="text-slate-200">Cliente:</strong> <?= e($project['cliente']) ?></p>
                            <p><strong class="text-slate-200">Ano:</strong> <?= e($project['ano']) ?></p>
                            <?php if (!empty($project['url'])): ?>
                                <p><strong class="text-slate-200">URL:</strong> <a class="text-white underline" href="<?= e($project['url']) ?>" target="_blank" rel="noopener">Acessar</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
