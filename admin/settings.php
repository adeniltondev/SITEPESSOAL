<?php
session_start();
require __DIR__ . '/_header.php';

$success = false;
$errors = [];

// Obter configuração atual
$stmt = $pdo->query('SELECT * FROM home_config LIMIT 1');
$config_data = $stmt->fetch();

if (!$config_data) {
    $pdo->exec('INSERT INTO home_config (id) VALUES (1)');
    $config_data = ['id' => 1, 'hero_image' => null];
}

if (is_post()) {
    // Upload de imagem de destaque
    if (!empty($_FILES['hero_image']['tmp_name'])) {
        $mime = mime_content_type($_FILES['hero_image']['tmp_name']);
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($mime, $allowed, true)) {
            $errors['hero_image'] = 'Apenas JPG, PNG e WEBP são permitidos.';
        } else {
            $ext = pathinfo($_FILES['hero_image']['name'], PATHINFO_EXTENSION);
            $filename = 'hero-' . uniqid() . '.' . $ext;
            $destination = $config['upload_dir'] . '/' . $filename;

            if (move_uploaded_file($_FILES['hero_image']['tmp_name'], $destination)) {
                // Remover imagem antiga se existir
                if (!empty($config_data['hero_image'])) {
                    $oldFile = __DIR__ . '/../' . ltrim($config_data['hero_image'], '/');
                    if (is_file($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $path = $config['upload_url'] . '/' . $filename;
                $stmt = $pdo->prepare('UPDATE home_config SET hero_image = :path WHERE id = 1');
                $stmt->execute([':path' => $path]);
                $success = true;
                $config_data['hero_image'] = $path;
            }
        }
    }

    // Remover imagem
    if (!empty($_POST['remove_image'])) {
        if (!empty($config_data['hero_image'])) {
            $filePath = __DIR__ . '/../' . ltrim($config_data['hero_image'], '/');
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
        $stmt = $pdo->prepare('UPDATE home_config SET hero_image = NULL WHERE id = 1');
        $stmt->execute();
        $success = true;
        $config_data['hero_image'] = null;
    }
}
?>

<div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold text-white">Configurações da Home</h1>
    <a href="/admin/index.php" class="text-sm text-gray-300 hover:text-lime-400">Voltar</a>
</div>

<div class="mt-6 rounded-2xl border border-lime-400/20 bg-gray-950 p-6">
    <h2 class="text-xl font-bold text-lime-400">Foto de Destaque (Hero)</h2>
    <p class="mt-2 text-sm text-gray-400">Imagem que aparece na seção principal da home. Recomendado: 1200x600px</p>

    <?php if ($success): ?>
        <div class="mt-4 rounded-xl border border-emerald-500/40 bg-emerald-500/10 p-3 text-sm text-emerald-200">
            Imagem atualizada com sucesso!
        </div>
    <?php endif; ?>

    <?php if (isset($errors['hero_image'])): ?>
        <div class="mt-4 rounded-xl border border-rose-500/40 bg-rose-500/10 p-3 text-sm text-rose-200">
            <?= e($errors['hero_image']) ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="mt-6 space-y-4">
        <?php if (!empty($config_data['hero_image'])): ?>
            <div class="rounded-xl border border-lime-400/20 bg-black p-4">
                <p class="text-sm font-semibold text-white">Imagem Atual</p>
                <img src="<?= e($config_data['hero_image']) ?>" alt="Hero Image" class="mt-4 h-48 w-full rounded-lg object-cover">
                <button type="submit" name="remove_image" value="1" class="mt-4 text-sm text-rose-300 hover:underline">Remover imagem</button>
            </div>
        <?php endif; ?>

        <div>
            <label class="text-sm font-semibold text-white">Selecionar nova imagem</label>
            <input name="hero_image" type="file" accept="image/*" class="mt-2 w-full text-sm text-gray-300">
            <p class="mt-1 text-xs text-gray-500">JPG, PNG ou WEBP. Máximo 5MB</p>
        </div>

        <button type="submit" class="rounded-full bg-lime-400 px-6 py-3 text-sm font-bold text-black hover:bg-lime-300">
            Atualizar
        </button>
    </form>
</div>

<?php require __DIR__ . '/_footer.php'; ?>
