<?php
session_start();
include_once "../../sql/conexao.php";

// Usuário deve estar logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../page/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $curso = trim($_POST['curso']);
    $instituicao = trim($_POST['instituicao']);
    $ano_conclusao = trim($_POST['ano_conclusao']);

    if (empty($curso) || empty($instituicao)) {
        header("Location: ../../page/perfil.php?error=" . urlencode("Preencha todos os campos."));
        exit;
    }

    $sql = $conn->prepare("
        INSERT INTO formacao (usuario_id, curso, instituicao, ano_conclusao)
        VALUES (?, ?, ?, ?)
    ");
    $sql->bind_param("isss", $usuario_id, $curso, $instituicao, $ano_conclusao);

    if ($sql->execute()) {
        header("Location: ../../page/perfil.php?sucesso=formacao_adicionada");
    } else {
        header("Location: ../../page/perfil.php?error=" . urlencode("Erro ao adicionar formação."));
    }
    exit;
}
?>
