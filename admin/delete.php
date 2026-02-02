<?php
session_start();
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../includes/functions.php';
require_login();

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if (!ctype_digit((string) $id)) {
    redirect('/admin/index.php');
}

switch ($type) {
    case 'project':
        $mediaStmt = $pdo->prepare('SELECT path FROM midias_projeto WHERE projeto_id = :id');
        $mediaStmt->execute([':id' => $id]);
        foreach ($mediaStmt->fetchAll() as $media) {
            $filePath = __DIR__ . '/../' . ltrim($media['path'], '/');
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
        $stmt = $pdo->prepare('DELETE FROM projetos WHERE id = :id');
        $stmt->execute([':id' => $id]);
        redirect('/admin/projects.php');
        break;
    case 'media':
        $stmt = $pdo->prepare('SELECT path FROM midias_projeto WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $media = $stmt->fetch();
        if ($media) {
            $filePath = __DIR__ . '/../' . ltrim($media['path'], '/');
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
        $stmt = $pdo->prepare('DELETE FROM midias_projeto WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $projectId = $_GET['project_id'] ?? '';
        redirect('/admin/project_form.php?id=' . $projectId);
        break;
    case 'message':
        $stmt = $pdo->prepare('DELETE FROM contatos WHERE id = :id');
        $stmt->execute([':id' => $id]);
        redirect('/admin/messages.php');
        break;
    default:
        redirect('/admin/index.php');
}
