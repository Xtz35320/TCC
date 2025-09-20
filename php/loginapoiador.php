<?php
session_start(); // Certifique-se de que a sessão é iniciada aqui

include_once '../sql/conexao.php'; // Inclui a conexão com o banco

// Exibe erros para debug (remover em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? ''); // Trima espaços extras
    $senha = $_POST['senha'] ?? ''; // Senha não tratada ainda

    // Verificação de campos obrigatórios
    if (empty($email) || empty($senha)) {
        echo "<script>alert('Preencha todos os campos.');</script>";
    } else {
        // Prepara a consulta para pegar dados do banco
        $stmt = $conn->prepare("SELECT id, nome, senha FROM apoiador WHERE email = ?");
        $stmt->bind_param('s', $email); // Previne SQL Injection
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            // Encontra o usuário
            $apoiador = $resultado->fetch_assoc();

            // Verifica se a senha bate com a armazenada
            if (password_verify($senha, $apoiador['senha'])) {
                // Login válido → salvar na sessão
                $_SESSION['apoiador_id'] = $apoiador['id'];
                $_SESSION['apoiador_nome'] = $apoiador['nome'];
                $_SESSION['apoiador'] = true;

                echo "<script>alert('Login realizado com sucesso!'); window.location.href='../page/index.php';</script>";
                exit;
            } else {
                echo "<script>alert('E-mail ou senha incorreta.'); window.location.href='../page/loginapoiador.php';</script>";
            }
        } else {
            echo "<script>alert('E-mail ou senha incorreta.'); window.location.href='../page/loginapoiador.php';</script>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
