<?php
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../includes/functions.php';

$created = false;
$message = '';

if (is_post()) {
    $name = trim($_POST['nome'] ?? 'Administrador');
    $email = trim($_POST['email'] ?? 'admin@seudominio.com');
    $password = $_POST['senha'] ?? 'Admin@123';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'E-mail inválido.';
    } elseif (strlen($password) < 8) {
        $message = 'Senha deve ter pelo menos 8 caracteres.';
    } else {
        $check = $pdo->query('SELECT COUNT(*) FROM usuarios')->fetchColumn();
        if ($check > 0) {
            $message = 'Já existe um usuário cadastrado.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha)');
            $stmt->execute([
                ':nome' => $name,
                ':email' => $email,
                ':senha' => $hash,
            ]);
            $created = true;
        }
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seed Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100">
    <div class="mx-auto flex min-h-screen max-w-md items-center px-6">
        <div class="w-full rounded-3xl border border-slate-800 bg-slate-950 p-8 shadow-xl">
            <h1 class="text-2xl font-semibold text-white">Criar usuário administrador</h1>
            <p class="mt-2 text-sm text-slate-400">Use uma vez e remova este arquivo.</p>
            <?php if ($message): ?>
                <div class="mt-4 rounded-xl border border-rose-500/40 bg-rose-500/10 p-3 text-sm text-rose-200"><?= e($message) ?></div>
            <?php endif; ?>
            <?php if ($created): ?>
                <div class="mt-4 rounded-xl border border-emerald-500/40 bg-emerald-500/10 p-3 text-sm text-emerald-200">Usuário criado com sucesso. Remova este arquivo.</div>
                <a href="/admin/login.php" class="mt-4 inline-block text-sm font-semibold text-white">Ir para login</a>
            <?php else: ?>
                <form method="post" class="mt-6 space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-slate-200">Nome</label>
                        <input name="nome" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" placeholder="Administrador">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-200">E-mail</label>
                        <input name="email" type="email" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" placeholder="admin@seudominio.com">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-200">Senha</label>
                        <input name="senha" type="password" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" placeholder="Admin@123">
                    </div>
                    <button type="submit" class="w-full rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-900">Criar usuário</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
