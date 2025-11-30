<?php
include_once "../sql/conexao.php";

session_start();

if (!isset($_SESSION['usuario_id'])) {

    $nome = "";
} else {

    $id = $_SESSION['usuario_id'];


    $sql_apoiador = "SELECT nome, imagem FROM usuarios WHERE id = $id";
    $result_apoiador = $conn->query($sql_apoiador);

    $nome = "";
    $imagem = "";
    if ($result_apoiador->num_rows > 0) {
        $row = $result_apoiador->fetch_assoc();
        $nome = $row['nome'];
        $imagem = $row['imagem'];
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>" />
    <link rel="shortcut icon"
        href="https://images.vexels.com/media/users/3/262042/isolated/preview/69326c8749e7a0bc882fbbe2a8e5fa50-icone-botanico-de-folha.png"
        type="image/png">
</head>

<body>
    <header>
        <nav id="menu">


            <div class="menu-center">
                <ul class="menu-list">
                    <li><a href="index.php">Início</a></li>

                    <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_tipo'] === "apoiador"): ?>
                        <li><a href="cadastro.php">Cadastro de plantas</a></li>
                    <?php else: ?>
                    <?php endif; ?>

                    <li><a href="ListaPlantas.php">Lista de plantas</a></li>

                    <li><a href="./identificar/identificar.php">Identificar planta</a></li>

                    <?php if (!isset($_SESSION['usuario_id'])): ?>
                    <?php else: ?>
                        <li><a href="avaliacao.php">Avalie aqui!</a></li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_tipo'] === "admin"): ?>
                        <li><a href="./admin/admin.php">Painel admin</a></li>
                    <?php else: ?>
                    <?php endif; ?>

                </ul>
            </div>


            <!-- LADO DIREITO (Nos apoie / Perfil) -->
            <div class="menu-right">
                <?php if (!isset($_SESSION['usuario_id'])): ?>
                    <a href="login.php" class="apoie-btn">Login</a>
                <?php else: ?>
                    <a href="./perfil.php" style="display:flex; align-items:center; gap:10px;">
                        <img src="<?php echo htmlspecialchars($imagem) ?>"
                            style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
                        <h5 style="margin:0;"><?php echo htmlspecialchars($nome) ?></h5>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <section class="about-container">
            <h1>Sobre Nós</h1>
            <p>Bem-vindo ao nosso site. Somos uma empresa dedicada a fornecer soluções de qualidade.</p>

            <div class="about-content">
                <div class="about-item">
                    <h2>Nossa Missão</h2>
                    <p>Entregar produtos e serviços de excelência para nossos clientes.</p>
                </div>
                <div class="about-item">
                    <h2>Nossa Visão</h2>
                    <p>Ser referência no mercado em inovação e qualidade.</p>
                </div>
                <div class="about-item">
                    <h2>Nossos Valores</h2>
                    <p>Integridade, transparência e excelência em tudo que fazemos.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Todos os direitos reservados.</p>
    </footer>
</body>

</html>