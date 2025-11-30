<?php
include_once '../sql/conexao.php';

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

if (!isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}

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
ORDER BY p.nome_popular ASC
";
$result = $conn->query($sql);
$plantas = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
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
          <li><a href="#" id="active-menu">Avalie aqui!</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_tipo'] === "admin"): ?>
          <li><a href="./admin/admin.php">Painel admin</a></li>
        <?php else: ?>
        <?php endif; ?>

      </ul>
    </div>


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

      <div class="email">
        <form id="form-email" style="display:flex; flex-direction:column; gap:4px; width:240px;">
          <input type="text" name="nome" placeholder="Nome" required style="padding:3px 5px; font-size:12px; height:24px;">
          <input type="email" name="email" placeholder="E-mail" required style="padding:3px 5px; font-size:12px; height:24px;">
          <input name="mensagem" placeholder="Mensagem" required style="padding:3px 5px; font-size:12px; height:25px; resize:none;"></input>
          <button id="btn-enviar" type="submit" style="padding:4px; background:#196901; color:#fff; border:none; cursor:pointer; font-size:12px; height:26px;">Enviar</button>
          <p id="status-msg" style="font-size:11px; margin:0;"></p>
        </form>
      </div>

      <div class="redes-sociais">

        <a href="https://www.instagram.com/botanmind9">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram"
            viewBox="0 0 16 16">
            <path
              d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
          </svg>
        </a>

        <a href="https://www.facebook.com/">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook"
            viewBox="0 0 16 16">
            <path
              d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
          </svg>
        </a>

        <a href="https://x.com/BotanMind9">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x"
            viewBox="0 0 16 16">
            <path
              d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
          </svg>
        </a>

      </div>
    </div>
    <p>© 2025 Botan Mind. Todos os direitos reservados.</p>
  </footer>

  <script>
    function toggleForm(button) {
      const form = button.nextElementSibling;
      form.style.display = form.style.display === 'flex' ? 'none' : 'flex';
    }

    
    document.addEventListener('DOMContentLoaded', function() {
      emailjs.init("wucfVf2nDk31TnkRP");

      const form = document.getElementById("form-email");
      const statusMsg = document.getElementById("status-msg");
      const btn = document.getElementById("btn-enviar");

      form.addEventListener("submit", function(e) {
        e.preventDefault();

        btn.disabled = true;
        btn.style.opacity = "0.6";
        statusMsg.textContent = "Enviando...";

        emailjs.sendForm("service_05rwahm", "template_gvh46zt", form)
          .then(function(response) {
            statusMsg.textContent = "Mensagem enviada com sucesso.";
            form.reset();
          }, function(error) {
            console.error("EmailJS error:", error);
            statusMsg.textContent = "Erro ao enviar. Tente novamente.";
          })
          .finally(function() {
            btn.disabled = false;
            btn.style.opacity = "1";
          });
      });
    });
  
  </script>



</body>

</html>