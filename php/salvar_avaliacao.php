<?php

// salvar_avaliacao.php
session_start();

// DEBUG: em ambiente de produção remova/ajuste
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../sql/conexao.php';
 // ajuste se seu caminho for diferente
// espera-se que conexao.php defina $conn como um objeto mysqli

// Verifica conexão
if (!isset($conn) || !($conn instanceof mysqli)) {
    http_response_code(500);
    echo "<script>alert('Erro: conexão com o banco não encontrada. Verifique conexao.php'); window.history.back();</script>";
    exit;
}

// Só apoiador logado pode avaliar
if (!isset($_SESSION['apoiador_id'])) {
    echo "<script>alert('Você precisa estar logado como apoiador para enviar uma avaliação.'); window.location.href = document.referrer || '/';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Requisição inválida.'); window.history.back();</script>";
    exit;
}

// Recupera dados com sanitização mínima
$apoiador_id = intval($_SESSION['apoiador_id']);
$planta_id = isset($_POST['planta_id']) ? intval($_POST['planta_id']) : 0;
$descricao = trim((string)($_POST['comentario'] ?? ''));

// Validações
if ($planta_id <= 0) {
    echo "<script>alert('Erro: planta inválida.'); window.history.back();</script>";
    exit;
}
if ($descricao === '') {
    echo "<script>alert('Escreva um comentário antes de enviar.'); window.history.back();</script>";
    exit;
}
// opcional: limitar tamanho a 255 chars
if (mb_strlen($descricao) > 255) {
    $descricao = mb_substr($descricao, 0, 255);
}

// Prepara insert usando prepared statement
$sql = "INSERT INTO avaliacao (apoiador_id, planta_id, descricao) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo "<script>alert('Erro no banco: " . addslashes($conn->error) . "'); window.history.back();</script>";
    exit;
}

$stmt->bind_param('iis', $apoiador_id, $planta_id, $descricao);

if ($stmt->execute()) {
    // sucesso: volta para a página anterior (referer) ou para a página de avaliação principal
    $referer = $_SERVER['HTTP_REFERER'] ?? '../paginas/avaliacao.php';
    // adiciona um parâmetro para poder mostrar uma mensagem no front se quiser
    $sep = (parse_url($referer, PHP_URL_QUERY) ? '&' : '?');
    $redirect = $referer . $sep . 'avaliacao_enviada=1';
    echo "<script>alert('Comentário enviado com sucesso!'); window.location.href = " . json_encode($redirect) . ";</script>";
    exit;
} else {
    echo "<script>alert('Falha ao salvar: " . addslashes($stmt->error) . "'); window.history.back();</script>";
    exit;
}

?>
