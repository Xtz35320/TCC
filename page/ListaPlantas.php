<?php
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
ORDER BY p.nome_popular ASC
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

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Botan Mind</title>
  <link rel="stylesheet" href="../css/style.css?v=1" />
    <link rel="shortcut icon" href="https://images.vexels.com/media/users/3/262042/isolated/preview/69326c8749e7a0bc882fbbe2a8e5fa50-icone-botanico-de-folha.png" type="image/png">

</head>
<body>

<nav id="menu">
    <ul class="menu-list">
      <li><a href="index.php">Início</a></li>
      <li><a href="#about">Sobre</a></li>
      <li><a href="cadastro.php">Cadastro de plantas</a></li>
      <li><a href="ListaPlantas.php" class="active">Lista de plantas</a></li>
    </ul>
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
                <p class="texto" style="display: -webkit-box; -webkit-line-clamp: 6; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><?= htmlspecialchars($planta['descricao']) ?></p>
                <span class="read-more-btn">Leia Mais</span>
              </div>
            </a>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Nenhuma planta encontrada.</p>
        <?php endif; ?>
      </div>  
  </main>

  <footer class="footer">
    <p>© 2024 Plantcare. Todos os direitos reservados.</p>
  </footer> 
</body>
</html>