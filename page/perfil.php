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


    //comentario

    $sql_avaliacao = "SELECT planta_id, descricao FROM avaliacao WHERE apoiador_id = $id";
    $result_avaliacao = $conn->query($sql_avaliacao);

    $planta_id = $descricao = "";
    if ($result_avaliacao->num_rows > 0) {
        $row = $result_avaliacao->fetch_assoc();
        $planta_id = $row['planta_id'];
        $descricao = $row['descricao'];
    }


    $sql_planta = "SELECT nome_popular FROM planta WHERE id = $planta_id";
    $result_planta = $conn->query($sql_planta);

    $nome_planta = "";
    if ($result_planta->num_rows > 0) {
        $row = $result_planta->fetch_assoc();
        $nome_planta = $row['nome_popular'];
    }


    $sql_imagem = "SELECT caminho_imagem FROM imagens WHERE planta_id = $planta_id";
    $result_imagem = $conn->query($sql_imagem);

    $caminho_imagem = "";
    if ($result_imagem->num_rows > 0) {
        $row = $result_imagem->fetch_assoc();
        $caminho_imagem = $row['caminho_imagem'];
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
            <li><a href="ListaPlantas.php">Lista de plantas</a></li>
            <?php if (!isset($_SESSION['apoiador_id'])): ?>
            <?php else: ?>
            <?php endif; ?>
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
                <!-- <form method="post">
                    <button class="btn_delete" type="submit" name="delete">Excluir</button>
                </form> -->
            </div>
        </div>
    </section>

    <?php
    if ($result_avaliacao && $result_avaliacao->num_rows > 0):
        while ($av = $result_avaliacao->fetch_assoc()):
    ?>
            <div style="display:flex; align-items:flex-start; gap:10px; margin-bottom:15px; background-color:#161616; border-radius:10px; padding:10px;">
                <img src="<?php echo htmlspecialchars($caminho_imagem); ?>"
                    style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
                <div>
                    <strong style="color:#1c7924;"><?php echo htmlspecialchars($nome_planta); ?>:</strong><br>
                    <span style="color:#ddd;"><?php echo htmlspecialchars($descricao); ?></span>
                </div>
            </div>
    <?php
        endwhile;
    else:
        echo "<p style='color:#aaa;'>Nenhuma avaliação ainda. Seja o primeiro a comentar!</p>";
    endif;
    ?>

    <script src="../js/index.js?v=1"></script>
</body>

</html>