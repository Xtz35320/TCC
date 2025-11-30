<?php
session_start();

include_once '../sql/conexao.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha)) {
        echo "<script>alert('Preencha todos os campos.');</script>";
        exit;
    }

    $stmt = $conn->prepare("
        SELECT id, nome, senha, tipo, status_aprovacao 
        FROM usuarios 
        WHERE email = ?
    ");
    
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {

            // ⚠️ BLOQUEIA APOIADOR NÃO APROVADO
            if ($usuario['tipo'] === 'apoiador' && $usuario['status_aprovacao'] !== 'aprovado') {
                echo "<script>alert('Seu cadastro ainda está em análise.'); window.location.href='../page/login.php';</script>";
                exit;
            }

            // Login OK
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];
            $_SESSION['logado'] = true;

            echo "<script>window.location.href='../page/index.php';</script>";
            exit;

        } else {
            echo "<script>alert('E-mail ou senha incorreta.'); window.location.href='../page/login.php';</script>";
        }

    } else {
        echo "<script>alert('E-mail ou senha incorreta.'); window.location.href='../page/login.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
