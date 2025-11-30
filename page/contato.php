<?php
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
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Botan Mind</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="https://images.vexels.com/media/users/3/262042/isolated/preview/69326c8749e7a0bc882fbbe2a8e5fa50-icone-botanico-de-folha.png" type="image/png">

</head>

<body>
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

  <div>
    <div>
      <h1 class="titulo">Nossos contatos</h1>
    </div>
    <div class="info_planta">
      <h2 class="subtitulo"><i>Telefone</i></h2>
      <h3 class="texto">
        99201-7439
      </h3>

    </div>
    <div class="info_planta">
      <h2 class="subtitulo"><i>Telefone</i></h2>
      <h3 class="texto">
        99201-7439
      </h3>

    </div>
  </div>
  <div class="gallery">
    <div class="gallery-item">
      <img src="path/to/image1.jpg" alt="Descrição da imagem 1">
      <p>Leonardo Muniz - </p>
    </div>
    <div class="gallery-item">
      <img src="path/to/image2.jpg" alt="Descrição da imagem 2">
      <p>Miguel Nascimento</p>
    </div>
    <div class="gallery-item">
      <img src="path/to/image3.jpg" alt="Descrição da imagem 3">
      <p>Pedro Otavio - +55 15 99710-1384</p>
    </div>
  </div>
  <div class="sobre">
    <h2>Sobre</h2>
    <p>.</p>
  </div>
  <link rel="stylesheet" href="../css/style.css" />
  </head>

  <body>
    <nav class="menu">
      <ul class="menu-list">
        <li><a href="index.php">Início</a></li>
        <li><a href="#about">Sobre</a></li>
        <li><a href="#">Contato</a></li>
        <li><a href="cadastro.php">Cadastro de plantas</a></li>
      </ul>
    </nav>

    <div>
      <div>
        <h1 class="titulo">Redes Sociais</h1>
      </div>
      <div class="info_planta">
        <h2 class="subtitulo"><i>Instagram</i></h2>
        <h3 class="texto">
        </h3>

      </div>
      <div class="info_planta">
        <h2 class="subtitulo"><i>Telefone</i></h2>
        <h3 class="texto">
          99201-7439
        </h3>

      </div>
    </div>
  </body>

</html>