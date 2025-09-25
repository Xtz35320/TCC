<?php

include_once '../sql/conexao.php';

include_once '../php/loginapoiador.php';

if (!isset($_SESSION['apoiador_id'])) {

    $nome = "";
} else {

    $id = $_SESSION['apoiador_id'];


    $sql_apoiador = "SELECT nome, imagem, cpf, emprego, email FROM apoiador WHERE id = $id";
    $result_apoiador = $conn->query($sql_apoiador);

    $nome = "";
    $imagem = "";
    $cpf = "";
    $emprego = "";
    $email = "";
    if ($result_apoiador->num_rows > 0) {
        $row = $result_apoiador->fetch_assoc();
        $nome = $row['nome'];
        $imagem = $row['imagem'];
        $cpf = $row['cpf'];
        $emprego = $row['emprego'];
        $email = $row['email'];
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Botan Mind</title>
    <link rel="stylesheet" href="../css/style.css?v=1" />
    <link rel="stylesheet" href="../css/mapa.css?v=1">
    <link rel="shortcut icon" href="https://images.vexels.com/media/users/3/262042/isolated/preview/69326c8749e7a0bc882fbbe2a8e5fa50-icone-botanico-de-folha.png" type="image/png">

</head>

<body>

    <div id="pdfModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <iframe id="modalIframe" class="modal-iframe"></iframe>
        </div>
    </div>

    <nav id="menu">
        <ul class="menu-list">
            <li><a href="index.php">Início</a></li>
            <li><a href="#about">Sobre</a></li>
            <?php if (!isset($_SESSION['apoiador_id'])): ?>
            <?php else: ?>
                <li><a href="cadastro.php">Cadastro de plantas</a></li>
            <?php endif; ?>
            <li><a href="ListaPlantas.php">Lista de plantas</a></li>
            <li><a href="loginapoiador.php">Nos apoie!</a></li>
        </ul>
    </nav>

    <div class="cabeca">

    </div>

    <div class="planta-e-pdf">
        <div class="informacoes-planta">

            <div class="card">

                <div class="bloco">
                    <div class="imagens" id="imagens">
                        <img src="<?php echo htmlspecialchars($imagem); ?>" alt="<?php echo htmlspecialchars($nome); ?>" />
                    </div>
                </div>

                <h1 class="titulo"><?php echo htmlspecialchars($nome) ?></h1>

            </div>

            <div class="card">
                <div class="info_planta">
                    <h1 class="titulo">Informações</h1>
                    <h3 class="texto">CPF: <?php echo htmlspecialchars($cpf) ?></h3>
                    <h3 class="texto">Emprego: <?php echo htmlspecialchars($emprego) ?></h3>
                    <h3 class="texto">Email: <?php echo htmlspecialchars($email) ?></h3>
                </div>
            </div>

            <div class="card">
                <button class="btn_deslogar" type="submit">Deslogar</button>
            </div>

            <script src="../js/index.js?v=1"></script>



</body>

</html>