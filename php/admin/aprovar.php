<?php
session_start();
include_once '../../sql/conexao.php';

// Garantir que só admin tenha acesso
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Validar ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);

// Atualizar status para aprovado
$sql = $conn->prepare("UPDATE usuarios SET status_aprovacao = 'aprovado' WHERE id = ? AND tipo = 'apoiador'");
$sql->bind_param("i", $id);
$sql->execute();

$sql->close();
$conn->close();

// Retornar ao painel
header("Location: ../../page/admin/admin.php");
exit;
?>
