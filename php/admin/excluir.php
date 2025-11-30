<?php
session_start();
include_once '../../sql/conexao.php';

// Apenas admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);

// Excluir usuário
$sql = $conn->prepare("DELETE FROM usuarios WHERE id = ? AND tipo = 'apoiador'");
$sql->bind_param("i", $id);
$sql->execute();

$sql->close();
$conn->close();

header("Location: ../../page/admin/admin.php");
exit;
?>
