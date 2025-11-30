<?php
session_start();

include_once '../sql/conexao.php';
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
ORDER BY p.id DESC LIMIT 6
";
$result = $conn->query($sql);

$plantas = [];
if ($result && $result->num_rows > 0) {
  // Pega tudo como array associativo para usar foreach
  $plantas = $result->fetch_all(MYSQLI_ASSOC);
}

$sql_img = "SELECT caminho_imagem, descricao FROM imagens LIMIT 1";
$result_img = $conn->query($sql_img);

$imagem = null;

if ($result_img && $result_img->num_rows > 0) {
  $imagem = $result_img->fetch_assoc(); // pega só a primeira linha
}




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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Botan Mind</title>
  <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>" />
  <link rel="shortcut icon"
    href="https://images.vexels.com/media/users/3/262042/isolated/preview/69326c8749e7a0bc882fbbe2a8e5fa50-icone-botanico-de-folha.png"
    type="image/png">
</head>

<body>

  <nav id="menu">


    <div class="menu-center">
      <ul class="menu-list">
        <li><a href="#" id="active-menu">Início</a></li>


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
          <img class="perfil-fotoI" src="<?php echo htmlspecialchars($imagem ?: '../assets/img/default-user.png'); ?>">
          <h5 style="margin:0;"><?php echo htmlspecialchars($nome) ?></h5>
        </a>
      <?php endif; ?>
    </div>

  </nav>



  <header class="hero-section">
    <div class="hero-overlay"><img src="../assets/img/floresta.jpg" alt=""></div>
    <div class="hero-content">
      <h1 class="titulo-index">Bem-vindo ao Botan Mind</h1>
      <p class="subtitulo-index">Seu guia completo para o mundo da botânica.</p>

      <div class="hero-buttons">
        <a href="ListaPlantas.php" class="btn-explore">Explorar Plantas</a>
        <a href="sobre.php" class="btn-about">Saiba Mais</a>
      </div>
    </div>
  </header>

  <section class="plant-knowledge">
    <h2>Curiosidades</h2>

    <div class="knowledge-grid">

      <div class="knowledge-card">
        <h3>A família das Asteráceas parece comum... mas não é!</h3>
        <p>Girassóis, margaridas e camomila são da mesma família e escondem várias flores dentro de uma só</p>
      </div>

      <div class="knowledge-card">
        <h3>Plantas da família Fabaceae "criam" o próprio fertilizante?</h3>
        <p>Sim! Feijões e ervilhas capturam nitrogênio do ar e deixam o solo mais fértil!</p>
      </div>

      <div class="knowledge-card">
        <h3>As Cactáceas não são só cactos</h3>
        <p>Essa família inclui mais de 1.700 espécies super adaptadas à vida com pouca água.</p>
      </div>

    </div>
  </section>

  <!-- ================= HERO INTRO ================= -->

  <section class="hero-intro">
    <h1>O melhor portal de dicas e informações de plantas</h1>

    <p>
      Descubra conteúdos exclusivos sobre cultivo, cuidados e curiosidades do mundo das plantas. Aqui você encontra
      guias completos, dicas de especialistas e tudo o que precisa para manter suas plantas saudáveis e bonitas.
    </p>

    <a class="hero-btn" href="ListaPlantas.php">Ver todas as plantas ></a>
  </section>



  <!-- ================= SUA SEÇÃO DE NOTÍCIAS ================= -->

  <section class="news-section">

    <div class="news-header">
      <h1>Os melhores conselhos para cuidar de suas plantas em um só lugar</h1>
      <p>
        Confira nossa seleção de conteúdos sobre plantas e fique por dentro dos
        assuntos mais importantes para quem ama plantinhas.
      </p>
    </div>

    <div class="news-layout">

      <!-- ======================  CARDS GRANDES ====================== -->
      <div class="news-grid">
        <a
          href="https://www.cnnbrasil.com.br/lifestyle/conheca-as-plantas-domesticas-que-podem-intoxicar-caes-e-gatos/">
          <article class="news-card">
            <div class="news-img">
              <span class="news-tag">PERIGO DAS PLANTAS</span>
              <img
                src="https://admin.cnnbrasil.com.br/wp-content/uploads/sites/12/2025/10/plantas-toxicas-pet.jpg?w=1200&h=900&crop=0">
            </div>
            <h3>Conheça as plantas domésticas que podem intoxicar cães e gatos</h3>
            <p>Ver conteúdo</p>
          </article>
        </a>
        <a
          href="https://www.cnnbrasil.com.br/tecnologia/pesquisador-indigena-cataloga-175-plantas-medicinais-usadas-por-seu-povo/">
          <article class="news-card">
            <div class="news-img">
              <span class="news-tag">PLANTAS MEDICINAIS</span>
              <img
                src="https://admin.cnnbrasil.com.br/wp-content/uploads/sites/12/2025/07/mastruz-e1752243437191.jpg?w=1200&h=900&crop=0">
            </div>
            <h3>Pesquisador indígena cataloga 175 plantas medicinais usadas por seu povo</h3>
            <p>Ver conteúdo</p>
          </article>
        </a>
        <a
          href="https://g1.globo.com/ciencia/noticia/2024/08/26/plantas-monstruosas-sao-um-dos-maiores-causadores-da-perda-de-especies-nativas-em-nivel-global.ghtml">
          <article class="news-card">
            <div class="news-img">
              <span class="news-tag">MANUAL DAS PLANTAS</span>
              <img
                src="https://s2-g1.glbimg.com/V3z1ljeuClGgX0TtYjgBjHDx5Dw=/0x0:1000x486/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2024/2/A/qafAi5Tkanr8EZhIB4Qg/adobestock-366274370-preview.jpeg">
            </div>
            <h3>'Plantas monstruosas' são um dos maiores causadores da perda de espécies nativas em nível global</h3>
            <p>Ver conteúdo</p>
          </article>
        </a>
        <a
          href="https://www.metropoles.com/ciencia/especies-plantas-mais-perigosas">
          <article class="news-card">
            <div class="news-img">
              <span class="news-tag">MANUAL DAS PLANTAS</span>
              <img
                src="https://uploads.metroimg.com/wp-content/uploads/2025/03/21173836/Trombeta-de-anjo.jpg">
            </div>
            <h3>Conheça as espécies de plantas mais perigosas encontradas na natureza</h3>
            <p>Ver conteúdo</p>
          </article>
        </a>
      </div>

      <!-- ======================  BARRA LATERAL ====================== -->

      <aside class="popular-box">
        <h2>Mais Populares:</h2>

        <div class="popular-item">
          <img
            src="https://s2-g1.glbimg.com/whBVgrTnPio4duPd_yv-iSN52rg=/0x0:960x641/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2018/7/O/hdjIlNSVAQnYKgTJWskg/samambaia.jpg">
          <p>Dicas de plantas fáceis de cuidar para ter dentro de casa</p>
        </div>

        <div class="popular-item">
          <img
            src="data:image/jpeg;base64,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">
          <p>Planta usada como adubo vira 'veneno' e mata cavalos no Brasil; entenda o perigo da crotalária</p>
        </div>

        <div class="popular-item">
          <img
            src="data:image/jpeg;base64,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">
          <p>Roxinha e perigosa: conheça o acônito, planta venenosa que pode matar um humano em 20 minutos</p>
        </div>

        <div class="popular-item">
          <img
            src="https://s2-g1.glbimg.com/81gPkBH1r2PYllV7nAovkGzXprQ=/0x0:5760x3840/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2018/Y/E/UuJwu3QuO19fGEcL7LYQ/imagem-1.jpg">
          <p>Fique atento! Certas árvores podem oferecer riscos para pessoas e animais</p>
        </div>

      </aside>

    </div>

  </section>





  <?php if (!isset($_SESSION['usuario_id'])): ?>
    <div style="width:100%; background: #196901ff; padding:40px 20px; text-align:center;">
      <h2>Ajude a manter o Botan Mind vivo!</h2>
      <p>Nosso site é feito com dedicação para compartilhar conhecimento sobre o mundo das plantas.
        Seu apoio é fundamental para continuarmos crescendo.</p>
      <a href="./cadastroapoiador.php">
        <button class="btn_cadastro"> Junte-se a nós</button>
      </a>
    </div>
  <?php else: ?>
  <?php endif; ?>


  <footer class="footer">
    <div class="rodape">
      <div class="logo">
        <img src="../assets/img/logo.png" class="logo-img" alt="">
      </div>
      <div class="paginas-rodape">
        <a href="#">
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
    <p>© 2025 Plantcare. Todos os direitos reservados.</p>

  </footer>
  <script src="../js/index.js?v=2"></script>
</body>
<style>
  .plant-knowledge {
    width: 100%;
    padding: 60px 40px;
    background: #121212;
    text-align: center;
    color: #e0e0e0;
  }

  .plant-knowledge h2 {
    font-size: 32px;
    font-weight: 700;
    color: #519129;
    margin-bottom: 35px;
  }

  /* ⬇️ Mantém os cards lado a lado */
  .knowledge-grid {
    display: flex;
    justify-content: center;
    align-items: stretch;
    gap: 25px;
    flex-wrap: wrap;
    /* quebra em telas pequenas */
  }

  /* ⬇️ COR PASTEL BONITA + FORMATO CORRETO */
  .knowledge-card {
    background: #1e1e1e;
    width: 300px;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 4px 14px #00000025;
    color: #d2e4c7ff;
    text-align: left;
    transition: 0.3s;
  }

  .knowledge-card h3 {
    color: #519129;
    margin-bottom: 15px;
  }

  /* ⬇️ AJUSTA O EMOJI */
  .knowledge-card .icon {
    font-size: 40px;
    display: block;
    margin-bottom: 12px;
  }

  /* ⬇️ EFEITO HOVER BONITO */
  .knowledge-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px #00000040;
  }

  /* <header class="hero-section"> */
  .hero-buttons {
    margin-top: 25px;
    display: flex;
    gap: 20px;
    justify-content: center;
  }

  .btn-explore,
  .btn-about {
    padding: 12px 20px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
  }

  .btn-explore {
    background: #ffffffcc;
    color: #145c25;
  }

  .btn-explore:hover {
    background: white;
  }

  .btn-about {
    border: 2px solid white;
    color: white;
  }

  .btn-about:hover {
    background: white;
    color: #145c25;
  }
</style>

</html>