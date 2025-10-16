<?php
include_once '../sql/conexao.php';
include_once '../php/loginapoiador.php';

if (isset($_POST['logout'])) {
    unset($_SESSION['apoiador_id']);
    header("Location: index.php");
    exit;
}


if (!isset($_SESSION['apoiador_id'])) {
    $nome = $imagem = $cpf = $emprego = $email = "";
} else {
    $id = $_SESSION['apoiador_id'];

    $sql_apoiador = "SELECT nome, imagem, cpf, emprego, email FROM apoiador WHERE id = $id";
    $result_apoiador = $conn->query($sql_apoiador);

    $nome = $imagem = $cpf = $emprego = $email = "";
    if ($result_apoiador->num_rows > 0) {
        $row = $result_apoiador->fetch_assoc();
        $nome = $row['nome'];
        $imagem = $row['imagem'];
        $cpf = $row['cpf'];
        $emprego = $row['emprego'];
        $email = $row['email'];
    }

    function formatarCPF($cpf)
    {
        $cpf = preg_replace('/\D/', '', (string)$cpf);
        if (strlen($cpf) !== 11) return '';
        return substr($cpf, 0, 3) . str_repeat('*', 6) . substr($cpf, -2);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Botan Mind | Perfil</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>" />
    <link rel="shortcut icon" href="https://images.vexels.com/media/users/3/262042/isolated/preview/69326c8749e7a0bc882fbbe2a8e5fa50-icone-botanico-de-folha.png" type="image/png">
</head>

<body>
    <nav id="menu">
        <ul class="menu-list">
            <li><a href="index.php">Início</a></li>
            <li><a href="#about">Sobre</a></li>
            <?php if (isset($_SESSION['apoiador_id'])): ?>
                <li><a href="cadastro.php">Cadastro de plantas</a></li>
            <?php endif; ?>
            <?php if (!isset($_SESSION['apoiador_id'])): ?>
            <?php else: ?>
                <li><a href="avaliacao.php">Avalie aqui!</a></li>
            <?php endif; ?>
            <li><a href="ListaPlantas.php">Lista de plantas</a></li>
        </ul>
    </nav>

    <section class="perfil-container">
        <div class="perfil-card">
            <img src="<?php echo htmlspecialchars($imagem ?: '../img/default-user.png'); ?>" alt="Foto de perfil" class="perfil-foto">
            <div class="perfil-info">
                <h2><?php echo htmlspecialchars($nome ?: 'Usuário não identificado'); ?></h2>
                <p><strong>CPF:</strong> <?php echo htmlspecialchars(formatarCPF($cpf)); ?></p>
                <p><strong>Emprego:</strong> <?php echo htmlspecialchars($emprego); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            </div>

            <div class="perfil-acoes">
                <form method="post">
                    <button class="btn_deslogar" type="submit" name="logout">Sair</button>
                </form>
            </div>
        </div>
    </section>

    <script src="../js/index.js?v=1"></script>
</body>

</html>