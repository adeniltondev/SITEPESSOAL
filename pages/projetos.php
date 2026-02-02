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
                <p class="text-sm font-bold uppercase tracking-[0.3em] text-lime-400">Projetos</p>
                <h1 class="mt-4 text-4xl font-bold text-white">Portfólio de projetos e entregas</h1>
                <p class="mt-4 text-lg text-gray-300">Resultados em marketing, CRM, sites e sistemas.</p>
            </div>
            <form method="get" class="flex items-center gap-3">
                <input type="hidden" name="page" value="projetos">
                <select name="categoria" class="rounded-xl border border-lime-400/20 bg-black px-4 py-2 text-sm text-white">
                    <option value="">Todas as categorias</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= e($cat) ?>" <?= $cat === $category ? 'selected' : '' ?>><?= e($cat) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="rounded-full bg-lime-400 px-4 py-2 text-sm font-bold text-black hover:bg-lime-300">Filtrar</button>
            </form>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php if (empty($projects)): ?>
                <div class="rounded-2xl border border-lime-400/20 bg-gray-950 p-6 text-gray-400">Nenhum projeto publicado ainda.</div>
            <?php endif; ?>
            <?php foreach ($projects as $project): ?>
                <?php
                $capaImage = $project['capa_image'] ?? '';
                $cover = $project['midias'][0]['path'] ?? '';
                $hasVideo = !empty(array_filter($project['midias'], fn($m) => $m['type'] === 'video'));
                $firstVideo = $hasVideo ? current(array_filter($project['midias'], fn($m) => $m['type'] === 'video')) : null;
                ?>
                <div class="card-hover rounded-2xl border border-lime-400/20 bg-gray-950 overflow-hidden hover:border-lime-400/50">
                    <div class="relative flex h-40 items-center justify-center rounded-t-xl bg-black text-gray-600">
                        <?php if ($capaImage): ?>
                            <img src="<?= e($capaImage) ?>" alt="<?= e($project['titulo']) ?>" class="h-full w-full object-cover">
                        <?php elseif ($hasVideo && $firstVideo): ?>
                            <video class="h-full w-full object-cover" poster="<?= e($cover) ?>"><source src="<?= e($firstVideo['path']) ?>" type="video/mp4"></video>
                        <?php elseif ($cover): ?>
                            <img src="<?= e($cover) ?>" alt="<?= e($project['titulo']) ?>" class="h-full w-full object-cover">
                        <?php else: ?>
                            <svg class="h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <?php endif; ?>
                        <?php if ($hasVideo && $firstVideo): ?>
                            <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                                <button data-modal-open="modal-<?= $project['id'] ?>" class="flex h-12 w-12 items-center justify-center rounded-full bg-lime-400 hover:bg-lime-300 transition">
                                    <svg class="h-6 w-6 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-6">
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-lime-400"><?= e($project['categoria']) ?></p>
                        <h3 class="mt-2 text-lg font-bold text-white"><?= e($project['titulo']) ?></h3>
                        <p class="mt-2 text-sm text-gray-400 line-clamp-3"><?= e($project['descricao']) ?></p>
                        <button data-modal-open="modal-<?= $project['id'] ?>" class="mt-4 text-sm font-bold text-lime-400 hover:text-lime-300">Ver detalhes</button>
                    </div>
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
