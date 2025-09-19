
<?php
include_once '../sql/conexao.php';
session_start();

   
    echo "<h1>Você está logado como apoiador ✅</h1>";
    echo "<p>Nome: " . $_SESSION['apoiador_nome'] . "</p>";
 ?>
