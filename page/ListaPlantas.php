<?php
include_once '../sql/conexao.php';
include_once '../php/login.php';

$plantas_por_pagina = 12;
$pagina_atual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $plantas_por_pagina;

$busca = isset($_GET['q']) ? trim($_GET['q']) : "";
$tagFiltro = isset($_GET['tag']) ? (int)$_GET['tag'] : 0;

if ($busca !== "" || $tagFiltro > 0) {
  $condicoes = [];

  if ($busca !== "") {
    $busca_sql = $conn->real_escape_string($busca);
    $condicoes[] = "p.nome_popular LIKE '%$busca_sql%'";
  }

  if ($tagFiltro > 0) {
    $condicoes[] = "p.id IN (
            SELECT planta_id FROM planta_tags WHERE tag_id = $tagFiltro
        )";
  }

  $where = implode(" AND ", $condicoes);

  $sql = "
        SELECT 
            p.id, p.nome_popular, p.descricao,
            (SELECT caminho_imagem FROM imagens WHERE planta_id = p.id LIMIT 1) AS caminho_imagem
        FROM planta p
        WHERE $where
        ORDER BY p.nome_popular ASC
        LIMIT $plantas_por_pagina OFFSET $offset
    ";

  $sql_total = "
        SELECT COUNT(*) AS total
        FROM planta p
        WHERE $where
    ";
} else {
  $sql = "
        SELECT 
            p.id, p.nome_popular, p.descricao,
            (SELECT caminho_imagem FROM imagens WHERE planta_id = p.id LIMIT 1) AS caminho_imagem
        FROM planta p
        ORDER BY p.nome_popular ASC
        LIMIT $plantas_por_pagina OFFSET $offset
    ";

  $sql_total = "SELECT COUNT(*) AS total FROM planta";
}

$result = $conn->query($sql);
$plantas = $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];

$total_result = $conn->query($sql_total);
$total_plantas = $total_result ? $total_result->fetch_assoc()['total'] : 0;
$total_paginas = ceil($total_plantas / $plantas_por_pagina);

$nome = $imagem = "";
if (isset($_SESSION['apoiador_id'])) {
  $id = $_SESSION['apoiador_id'];
  $sql_apoiador = "SELECT nome, imagem FROM usuarios WHERE id = $id";
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Botan Mind | Lista de Plantas</title>
  <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>" />
  <link rel="shortcut icon" href="https://images.vexels.com/media/users/3/262042/isolated/preview/69326c8749e7a0bc882fbbe2a8e5fa50-icone-botanico-de-folha.png" type="image/png">
</head>

<body>
  <nav id="menu">
    <ul class="menu-list">
      <li><a href="index.php">Início</a></li>
      <li><a href="#about">Sobre</a></li>
      <?php if (isset($_SESSION['apoiador_id']) && ($_SESSION['apoiador_tipo'] == 'apoiador' || $_SESSION['apoiador_tipo'] == 'admin')): ?>
        <li><a href="cadastro.php">Cadastro de plantas</a></li>
      <?php endif; ?>
      <?php if (isset($_SESSION['apoiador_id'])): ?>
        <li><a href="avaliacao.php">Avalie aqui!</a></li>
      <?php endif; ?>
      <li><a href="./identificar/identificar.php">Identifique</a></li>
      <?php if (!isset($_SESSION['apoiador_id'])): ?>
        <li><a href="login.php">Nos apoie!</a></li>
      <?php endif; ?>
    </ul>

    <div style="display:flex; gap:10px; align-items:center;">

      <!-- BUSCA -->
      <div class="search-container">
        <form action="ListaPlantas.php" method="get" class="search-form">
          <input type="text" name="q" class="search-input" placeholder="Pesquisar por plantas">
          <button type="submit" class="search-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </button>
        </form>
      </div>


      <!-- FILTRO POR TAG -->
      <div class="tag-filter-container">
        <form action="ListaPlantas.php" method="get" class="tag-form">
          <select name="tag" onchange="this.form.submit()" class="tag-select <?= isset($_GET['tag']) && $_GET['tag'] != '' ? 'has-filter' : '' ?>">
            <option value="">Filtrar por tag</option>
            <?php
            $tags = $conn->query("SELECT * FROM tags ORDER BY nome_tag ASC");
            while ($tag = $tags->fetch_assoc()):
            ?>
              <option value="<?= $tag['id'] ?>"
                <?= isset($_GET['tag']) && $_GET['tag'] == $tag['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($tag['nome_tag']) ?>
              </option>
            <?php endwhile; ?>
          </select>
          <?php if (isset($_GET['q']) && $_GET['q'] != ''): ?>
            <input type="hidden" name="q" value="<?= htmlspecialchars($_GET['q']) ?>">
          <?php endif; ?>
        </form>
      </div>


    </div>

    <?php if ($nome): ?>
      <a href="./perfil.php" style="display:flex; align-items:center; gap:10px;">
        <img src="<?php echo htmlspecialchars($imagem) ?>" style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
        <h5 style="margin:0; display:inline-block; white-space:nowrap;"><?php echo htmlspecialchars($nome) ?></h5>
      </a>
    <?php endif; ?>
  </nav>

  <main class="listar-container">
    <h2 class="titulo-listar" style="margin-top: 100px;">Plantas</h2>
    <div class="listar-grid">
      <?php if (count($plantas) > 0): ?>
        <?php foreach ($plantas as $planta): ?>
          <a href="template_page.php?id=<?= htmlspecialchars($planta['id']) ?>" class="listar-card">
            <img src="<?= htmlspecialchars($planta['caminho_imagem']) ?>" alt="Planta <?= htmlspecialchars($planta['nome_popular']) ?>" class="listar-card-img">
            <div class="listar-card-content">
              <h3 class="titulo"><?= htmlspecialchars($planta['nome_popular']) ?></h3>
              <p class="texto" style="display: -webkit-box; -webkit-line-clamp: 6; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                <?= htmlspecialchars($planta['descricao']) ?>
              </p>
              <span class="read-more-btn">Leia Mais</span>
            </div>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Nenhuma planta encontrada.</p>
      <?php endif; ?>
    </div>

    <?php if ($total_paginas > 1): ?>
      <div class="paginacao">
        <?php if ($pagina_atual > 1): ?>
          <a href="?pagina=<?= $pagina_atual - 1 ?>">« Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
          <a href="?pagina=<?= $i ?>" class="<?= $i === $pagina_atual ? 'ativo' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($pagina_atual < $total_paginas): ?>
          <a href="?pagina=<?= $pagina_atual + 1 ?>">Próxima »</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </main>

  <footer class="footer">
    <div class="rodape">
      <div class="logo">
        <img src="../assets/img/logo.png" class="logo-img" alt="">
      </div>

      <div class="paginas-rodape">
        <a href="index.php">
          <h5>Início</h5>
        </a>
        <a href="ListaPlantas.php">
          <h5>Lista de planta</h5>
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
        <a href="https://www.instagram.com/botanmind9">INSTAGRAM</a>
        <a href="https://www.facebook.com/">FACEBOOK</a>
        <a href="https://x.com/BotanMind9">TWITTER</a>
      </div>
    </div>

    <p>© 2025 Plantcare. Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>

  <script>
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