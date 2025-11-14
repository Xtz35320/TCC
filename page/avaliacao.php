<?php
include_once '../sql/conexao.php';
include_once '../php/loginapoiador.php';

// Consulta das plantas
$sql = "
SELECT 
    p.id, p.nome_popular, p.nome_cientifico, p.descricao, p.cuidados, p.video_link,
    (
        SELECT caminho_imagem 
        FROM imagens i 
        WHERE i.planta_id = p.id  
        ORDER BY i.id ASC 
        LIMIT 1
    ) AS caminho_imagem
FROM planta p
ORDER BY p.id DESC
LIMIT 6
";
$result = $conn->query($sql);
$plantas = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Dados do apoiador logado
$nome = $imagem = "";
if (isset($_SESSION['apoiador_id'])) {
  $id = $_SESSION['apoiador_id'];
  $sql_apoiador = "SELECT nome, imagem FROM apoiador WHERE id = $id";
  $result_apoiador = $conn->query($sql_apoiador);
  if ($result_apoiador && $result_apoiador->num_rows > 0) {
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
  <title>Botan Mind | Avaliação de Plantas</title>
  <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>">
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
        <li><a href="loginapoiador.php">Nos apoie!</a></li>
      <?php endif; ?>
      <li><a href="avaliacao.php">Avalie aqui!</a></li>
    </ul>

    <?php if ($nome): ?>
      <a href="./perfil.php" style="display:flex; align-items:center; gap:10px;">
        <img src="<?php echo htmlspecialchars($imagem) ?>" style="width:40px; height:40px; object-fit:cover; border-radius:50%;" >
        <h5 style="margin:0;"><?php echo htmlspecialchars($nome) ?></h5>
      </a>
    <?php endif; ?>
  </nav>

  <header class="hero-section">
    <div class="hero-overlay">
      <img src="../assets/img/floresta.jpg" alt="">
    </div>
    <div class="hero-content">
      <h1 class="titulo-index">Avalie as plantas do Botan Mind</h1>
      <p class="subtitulo-index">Compartilhe sua experiência e ajude outros amantes da botânica.</p>
    </div>
  </header>

  <main class="avaliacao-container">
    <h2 class="titulo-avaliacao">Plantas Recentes</h2>


    <div class="plantas-grid">
      <?php foreach ($plantas as $planta): ?>
        <div class="planta-card">
          <img src="<?php echo htmlspecialchars($planta['caminho_imagem']); ?>" alt="<?php echo htmlspecialchars($planta['nome_popular']); ?>" class="planta-img">
          <div class="planta-content">
            <h3><?php echo htmlspecialchars($planta['nome_popular']); ?></h3>
            <p><i><?php echo htmlspecialchars($planta['nome_cientifico']); ?></i></p>
            <p><?php echo nl2br(htmlspecialchars(substr($planta['descricao'], 0, 100))); ?>...</p>
            <button class="btn-avaliar" onclick="toggleForm(this)">Avaliar</button>

            <form class="avaliacao-form" method="post" action="../php/salvar_avaliacao.php">
              <input type="hidden" name="planta_id" value="<?php echo htmlspecialchars($planta['id']); ?>">

              <textarea name="comentario" id="comentario" placeholder="Escreva sua avaliação..."></textarea>
              <button type="submit" class="btn-avaliar">Enviar</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
      
    </div>
  </main>

  <footer class="footer">
    <div class="rodape">
      <div class="logo">
        <img src="../assets/img/logo.png" class="logo-img" alt="Botan Mind">
      </div>
      <div class="paginas-rodape">
        <a href="./index.php">
          <h5>Início</h5>
        </a>
        <a href="ListaPlantas.php">
          <h5>Lista de plantas</h5>
        </a>
        <a href="sobre.php">
          <h5>Sobre</h5>
        </a>
        <a href="contato.php">
          <h5>Contato</h5>
        </a>
      </div>
      <div class="redes-sociais">
        <a href="https://www.instagram.com/botanmind9">Instagram</a>
        <a href="https://x.com/BotanMind9">Twitter</a>
      </div>
    </div>
    <p>© 2025 Botan Mind. Todos os direitos reservados.</p>
  </footer>

  <script>
    function toggleForm(button) {
      const form = button.nextElementSibling;
      form.style.display = form.style.display === 'flex' ? 'none' : 'flex';
    }
  </script>



</body>

</html>