<?php
// Contato
$success = false;
$errors = [];
$name = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['telefone'] ?? '';
$message = $_POST['mensagem'] ?? '';

if (is_post()) {
    if (trim($name) === '') {
        $errors['nome'] = 'Informe seu nome.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Informe um e-mail válido.';
    }
    if (trim($message) === '') {
        $errors['mensagem'] = 'Escreva sua mensagem.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO contatos (nome, email, telefone, mensagem, criado_em) VALUES (:nome, :email, :telefone, :mensagem, NOW())");
        $stmt->execute([
            ':nome' => $name,
            ':email' => $email,
            ':telefone' => $phone,
            ':mensagem' => $message,
        ]);
        $success = true;
        $name = $email = $phone = $message = '';
    }
}
?>
<section class="fade-in">
    <div class="mx-auto grid max-w-6xl gap-10 px-6 py-16 lg:grid-cols-2">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Contato</p>
            <h1 class="mt-4 text-4xl font-semibold text-white">Vamos conversar sobre seu projeto</h1>
            <p class="mt-4 text-lg text-slate-300">Respondo em até 24 horas úteis com uma proposta inicial.</p>
            <div class="mt-8 rounded-2xl border border-slate-800 bg-slate-950 p-6 text-slate-300">
                <p class="text-base font-semibold text-white">Consultoria em marketing & tecnologia</p>
                <p class="mt-2 text-sm">Planejamento, CRM, automações e desenvolvimento de sites e sistemas.</p>
            </div>
        </div>
        <div class="rounded-3xl border border-slate-800 bg-slate-950 p-8">
            <?php if ($success): ?>
                <div class="mb-4 rounded-xl border border-emerald-500/40 bg-emerald-500/10 p-4 text-emerald-200">
                    Mensagem enviada com sucesso. Obrigado pelo contato!
                </div>
            <?php endif; ?>
            <form method="post" class="space-y-4">
                <div>
                    <label class="text-sm font-semibold text-slate-200">Nome</label>
                    <input name="nome" value="<?= e($name) ?>" required class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" placeholder="Seu nome">
                    <?php if (isset($errors['nome'])): ?>
                        <p class="mt-1 text-xs text-rose-300"><?= e($errors['nome']) ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-200">E-mail</label>
                    <input name="email" type="email" value="<?= e($email) ?>" required class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" placeholder="voce@email.com">
                    <?php if (isset($errors['email'])): ?>
                        <p class="mt-1 text-xs text-rose-300"><?= e($errors['email']) ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-200">Telefone</label>
                    <input name="telefone" value="<?= e($phone) ?>" class="mt-2 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" placeholder="(00) 00000-0000">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-200">Mensagem</label>
                    <textarea name="mensagem" required class="mt-2 h-32 w-full rounded-xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-slate-200" placeholder="Descreva seu desafio..."><?= e($message) ?></textarea>
                    <?php if (isset($errors['mensagem'])): ?>
                        <p class="mt-1 text-xs text-rose-300"><?= e($errors['mensagem']) ?></p>
                    <?php endif; ?>
                </div>
                <button type="submit" class="w-full rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-900">Enviar mensagem</button>
            </form>
        </div>
    </div>
</section>
