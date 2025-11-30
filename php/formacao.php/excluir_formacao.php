<?php
session_start();
include_once "../../sql/conexao.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../page/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if (!isset($_GET['id'])) {
    header("Location: ../../page/perfil.php");
    exit;
}

$formacao_id = intval($_GET['id']);

// Verifica se a formação pertence ao usuário
$sql = $conn->prepare("SELECT id FROM formacao WHERE id = ? AND usuario_id = ?");
$sql->bind_param("ii", $formacao_id, $usuario_id);
$sql->execute();
$res = $sql->get_result();

if ($res->num_rows === 0) {
    header("Location: ../../page/perfil.php?error=nao_autorizado");
    exit;
}

$sql = $conn->prepare("DELETE FROM formacao WHERE id = ?");
$sql->bind_param("i", $formacao_id);
$sql->execute();

header("Location: ../../page/perfil.php?sucesso=formacao_excluida");
exit;
?>
