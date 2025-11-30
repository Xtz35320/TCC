<?php
session_start();
include_once "../../sql/conexao.php";

if (!isset($_SESSION['usuario_id'])) {
  $nome = "";
} else {

  $id = $_SESSION['usuario_id'];
  $tipo = $_SESSION['usuario_tipo'];

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
  <meta charset="UTF-8" />
  <title>Identificar Planta</title>
  <link rel="stylesheet" href="../../css/style.css?v=<?php echo filemtime('../../css/style.css'); ?>">

  <style>
    body {
      background: #121212;
      margin: 0;
      padding: 0;
      color: #ffffff;
    }

    #resultado {
      padding: 20px;
      border-radius: 8px;
      background-color: #1e1e1e;
      color: white;
      margin: 20px 120px 60px;
      min-height: 80px;
    }
  </style>
</head>

<body>

  <nav id="menu">

    
    <div class="menu-center">
      <ul class="menu-list">
        <li><a href="../index.php">Início</a></li>


        <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_tipo'] === "apoiador" ): ?>
          <li><a href="../cadastro.php">Cadastro de plantas</a></li>
        <?php else: ?>
        <?php endif; ?>

        <li><a href="../ListaPlantas.php">Lista de plantas</a></li>

        <li><a href="#" id="active-menu">Identificar planta</a></li>

        <?php if (!isset($_SESSION['usuario_id'])): ?>
        <?php else: ?>
          <li><a href="../avaliacao.php">Avalie aqui!</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_tipo'] === "admin" ): ?>
          <li><a href="../admin/admin.php">Painel admin</a></li>
        <?php else: ?>
        <?php endif; ?>

      </ul>
    </div>


    <!-- LADO DIREITO (Login / Perfil) -->
    <div class="menu-right">
      <?php if (!isset($_SESSION['usuario_id'])): ?>
        <a href="login.php" class="apoie-btn">Login</a>
      <?php else: ?>
        <a href="./perfil.php" style="display:flex; align-items:center; gap:10px;">
          <img src="../<?php echo htmlspecialchars($imagem ?: '../img/default-user.png'); ?>"
            style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
          <h5 style="margin:0;"><?php echo htmlspecialchars($nome) ?></h5>
        </a>
      <?php endif; ?>
    </div>
  </nav>


  <!-- CONTEÚDO PRINCIPAL -->
  <div style="
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin:120px auto;
      width:90%;
      max-width:1300px;
    ">

    <!-- LADO ESQUERDO -->
    <div style="width:50%;">
      <h1 style="font-size:50px; font-weight:800; line-height:1.1; color:white;">
        Identifique, explore e <br>
        compartilhe suas <br>
        observações de <br>
        plantas silvestres
      </h1>

      <p style="font-size:20px; margin-top:20px; color:#cccccc;">
        Botanmind é uma ferramenta para te ajudar a identificar plantas com imagens. Experimente!
      </p>
    </div>

    <!-- LADO DIREITO -->
    <div style="
      width:45%;
      background:#1d1d1d;
      border:3px dashed #4e7f3d;
      border-radius:20px;
      padding:40px;
      text-align:center;
      min-height:260px;
      display:flex;
      flex-direction:column;
      justify-content:center;
      align-items:center;
    ">
      <p style="font-size:22px; font-weight:600; margin-bottom:20px; color:white;">
        Selecione a foto de uma <br>
        planta para identificá-la
      </p>

      <form id="form" style="display:flex; flex-direction:column; align-items:center;">
        
        <input type="file" id="imagem" accept="image/*" style="display:none;">

        <label for="imagem"
          style="
            background:#8cc04a;
            color:white;
            padding:12px 25px;
            border-radius:10px;
            font-size:18px;
            cursor:pointer;
            font-weight:600;
          ">
          Selecione uma imagem!
        </label>

        <button type="submit"
          style="
            margin-top:25px;
            background:#4a7c2c;
            color:white;
            padding:12px 22px;
            border-radius:10px;
            border:none;
            font-size:18px;
            cursor:pointer;
            font-weight:600;
          ">
          Enviar
        </button>
      </form>
    </div>

  </div>

  <h2 style="margin:20px 120px 0; color:white;">Resultado:</h2>

  <div id="resultado"></div>

  <script src="script.js"></script>

</body>

</html>