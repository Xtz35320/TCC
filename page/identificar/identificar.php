<?php

// include_once '../../php/login.php';


if (!isset($_SESSION['apoiador_id'])) {

  $nome = "";
} else {

  $id = $_SESSION['apoiador_id'];
  $tipo = $_SESSION['apoiador_tipo'];

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
</head>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 200px;
  }

  h1 {
    color: #2E8B57;
  }

  #form {
    margin-bottom: 20px;
  }

  #resultado {
    padding: 10px;
    border-radius: 5px;
    background-color: #313131ff;
  }
</style>

<body>

  <nav id="menu">
    <ul class="menu-list">
      <li><a href="../index.php">Início</a></li>
      <li><a href="../sobre.php">Sobre</a></li>
      <?php if (isset($_SESSION['apoiador_id'])): ?>
        <li><a href="../cadastro.php">Cadastro de plantas</a></li>
      <?php endif; ?>
      <li><a href="../ListaPlantas.php">Lista de plantas</a></li>
      <?php if (isset($_SESSION['apoiador_id'])): ?>
        <li><a href="../avaliacao.php">Avalie aqui!</a></li>
      <?php endif; ?>
      <?php if (!isset($_SESSION['apoiador_id'])): ?>
        <li><a href="../login.php">Nos apoie!</a></li>
      <?php endif; ?>
    </ul>

    <?php if (!isset($_SESSION['apoiador_id'])): ?>
    <?php else: ?>
      <a href="../perfil.php" style="display:flex; align-items:center; gap:10px;">
        <img src="<?php echo htmlspecialchars($imagem) ?>" style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
        <h5 style="margin:0;"><?php echo htmlspecialchars($nome) ?></h5>
      </a>
    <?php endif; ?>

  </nav>

  <h1>Identificar Planta</h1>

  <form id="form">
    <input type="file" id="imagem" accept="image/*" style="margin-bottom: 10px;">
    <button type="submit" class="read-more-btn">Enviar</button>
  </form>

  <h2>Resultado:</h2>

  <div id="resultado" style="margin-top: 20px; font-family: Arial;"></div>

  <script src="script.js"></script>

</body>

</html>