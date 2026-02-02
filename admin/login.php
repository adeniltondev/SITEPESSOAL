<?php
session_start();
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../includes/functions.php';

if (!empty($_SESSION['user_id'])) {
    redirect('/admin/index.php');
}

$errors = [];
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (is_post()) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'E-mail inválido.';
    }
    if (trim($password) === '') {
        $errors['password'] = 'Informe a senha.';
    }
    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id, nome, senha_hash FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['senha_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            redirect('/admin/index.php');
        }
        $errors['login'] = 'Credenciais inválidas.';
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Painel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="bg-slate-950 text-slate-100">
    <div class="mx-auto flex min-h-screen max-w-md items-center px-6">
        <div class="w-full rounded-3xl border border-slate-800 bg-slate-950 p-8 shadow-xl">
            <h1 class="text-2xl font-semibold text-white">Acesso administrativo</h1>
            <p class="mt-2 text-sm text-slate-400">Entre com suas credenciais.</p>
            <?php if (isset($errors['login'])): ?>
                <div class="mt-4 rounded-xl border border-rose-500/40 bg-rose-500/10 p-3 text-sm text-rose-200"><?= e($errors['login']) ?></div>
            <?php endif; ?>
            <form method="post" class="mt-6 space-y-4">
                <div>
                    <label class="text-sm font-semibold text-slate-200">E-mail</label>
                    <input name="email" type="email" value="<?= e($email) ?>" required class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200">
                    <?php if (isset($errors['email'])): ?>
                        <p class="mt-1 text-xs text-rose-300"><?= e($errors['email']) ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-200">Senha</label>
                    <input name="password" type="password" required class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200">
                    <?php if (isset($errors['password'])): ?>
                        <p class="mt-1 text-xs text-rose-300"><?= e($errors['password']) ?></p>
                    <?php endif; ?>
                </div>
                <button type="submit" class="w-full rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-900">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>
