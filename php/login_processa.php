<?php
// login_processa.php

session_start(); // Inicia a sessão

// Obter dados do formulário (simplificado para exemplo)
$usuario_digitado = $_POST['usuario'];
$senha_digitada = $_POST['senha'];

// ----- LÓGICA DO BANCO DE DADOS (Exemplo) -----
// Suponha que você tenha conectado ao banco de dados e buscado o usuário
// $sql = "SELECT id, usuario, senha FROM usuarios WHERE usuario = '$usuario_digitado'";
// $resultado = $mysqli->query($sql);
// $usuario_db = $resultado->fetch_assoc(); // Obter dados do banco


if ($usuario_db && password_verify($senha_digitada, $usuario_db['senha'])) {
    // Credenciais corretas
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $usuario_db['id'];
    $_SESSION['usuario'] = $usuario_db['usuario'];

    // Redirecionar para a página protegida
    header("Location: ../page/loginapoiador.php");
    exit(); // Essencial para parar a execução
} else {
    // Credenciais inválidas
    echo "<script>alert('Usuário ou senha inválidos.');</script>";
    echo "<script>window.location.href='../page/loginapoiador.php';</script>"; // Retorna para o login
}
?>