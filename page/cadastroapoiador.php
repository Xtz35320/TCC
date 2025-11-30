<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../sql/conexao.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $nome = trim($_POST['nome']);
  $email = trim($_POST['email']);
  $cpf = trim($_POST['cpf']);
  $senha = $_POST['senha'];

  if (empty($nome) || empty($email) || empty($cpf) || empty($senha)) {
    echo "<p style='color:red; text-align:center;'>Preencha todos os campos obrigatórios.</p>";
  } else {

    // Upload da imagem
    $imagem = "";
    if (!empty($_FILES['imagem']['name'])) {
      $pasta = 'uploads/';
      if (!is_dir($pasta)) mkdir($pasta, 0777, true);

      $nomeArquivo = uniqid() . "_" . basename($_FILES['imagem']['name']);
      $caminho = $pasta . $nomeArquivo;

      if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
        $imagem = $caminho;
      }
    }

    // Criar hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // TRANSAÇÃO — garante tudo ou nada
    $conn->begin_transaction();

    try {

      // 1. Criar usuário
      $sql = $conn->prepare("
                INSERT INTO usuarios (nome, email, cpf, imagem, senha, tipo, status_aprovacao)
                VALUES (?, ?, ?, ?, ?, 'apoiador', 'pendente')
            ");
      $sql->bind_param("sssss", $nome, $email, $cpf, $imagem, $senhaHash);
      $sql->execute();

      $novo_usuario_id = $conn->insert_id;

      // 2. Inserir formações
      if (!empty($_POST['curso'])) {

        $sqlForm = $conn->prepare("
                    INSERT INTO formacoes (usuario_id, curso, instituicao, ano_conclusao)
                    VALUES (?, ?, ?, ?)
                ");

        foreach ($_POST['curso'] as $i => $curso) {
          $curso = trim($curso);
          $inst = trim($_POST['instituicao'][$i]);
          $ano  = trim($_POST['ano'][$i]);

          if ($curso !== "" && $inst !== "") {
            $sqlForm->bind_param("isss", $novo_usuario_id, $curso, $inst, $ano);
            $sqlForm->execute();
          }
        }
      }

      // Se tudo deu certo → commit
      $conn->commit();

      $mensagem = "<p style='color:green; text-align:center;'>Cadastro realizado! Aguarde a aprovação do administrador.</p>";
    } catch (Exception $e) {

      $conn->rollback(); // desfaz tudo

      $mensagem = "<p style='color:red; text-align:center;'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Apoiador | Botan Mind</title>
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
  <link rel="shortcut icon"
    href="https://images.vexels.com/media/users/3/262042/isolated/preview/69326c8749e7a0bc882fbbe2a8e5fa50-icone-botanico-de-folha.png"
    type="image/png">
</head>

<body>

  <!-- MENU (mantido igual ao seu) -->
  <nav id="menu">
    <div class="menu-center">
      <ul class="menu-list">
        <li><a href="index.php">Início</a></li>
        <li><a href="ListaPlantas.php">Lista de plantas</a></li>
        <li><a href="identificar/identificar.php">Identificar planta</a></li>

        <?php if (isset($_SESSION['usuario_id'])): ?>
          <li><a href="avaliacao.php">Avalie aqui!</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === "admin"): ?>
          <li><a href="./admin/admin.php">Painel admin</a></li>
        <?php endif; ?>
      </ul>
    </div>

    <div class="menu-right">
      <?php if (!isset($_SESSION['usuario_id'])): ?>
        <a href="login.php" class="apoie-btn">Login</a>
      <?php else: ?>
        <a href="./perfil.php" style="display:flex; align-items:center; gap:10px;">
          <img src="<?php echo htmlspecialchars($imagem ?: '../img/default-user.png'); ?>"
            style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
          <h5 style="margin:0;"><?php echo htmlspecialchars($nome); ?></h5>
        </a>
      <?php endif; ?>
    </div>
  </nav>



  <main style="margin-top:80px; min-height:60vh;">
    <div class="form-apoiador" style="max-width:500px; margin:60px auto;">
      <h2 class="h2c">Cadastro de Apoiador</h2>
      <?php if (!empty($mensagem)) echo $mensagem; ?>
      <!-- FORMULÁRIO -->
      <form class="form-login" action="" method="POST" enctype="multipart/form-data">

        <label>Nome: <input type="text" name="nome" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>CPF: <input type="text" name="cpf" maxlength="11" required></label><br>
        <label>Senha: <input type="password" name="senha" minlength="8" required></label><br>
        <label>Imagem (opcional): <input type="file" name="imagem" accept="image/*"></label><br>

        <hr>
        <h3>Formações</h3>

        <div id="formacoes-container">
          <div class="formacao-item">
            <label>Curso:
              <input type="text" name="curso[]" required>
            </label>

            <label>Instituição:
              <input type="text" name="instituicao[]" required>
            </label>

            <label>Ano de Conclusão (opcional):
              <input type="number" name="ano[]" min="1900" max="2100">
            </label>

            <hr>
          </div>
        </div>

        <button type="button" onclick="addFormacao()" style="margin-bottom:10px;">
          + Adicionar formação
        </button>

        <button type="submit" class="btn_cadastro" style="width:100%;">Cadastrar</button>
      </form>

      <script>
        function addFormacao() {
          const container = document.getElementById('formacoes-container');

          const div = document.createElement('div');
          div.classList.add('formacao-item');

          div.innerHTML = `
        <label>Curso:
            <input type="text" name="curso[]" required>
        </label>

        <label>Instituição:
            <input type="text" name="instituicao[]" required>
        </label>

        <label>Ano de Conclusão (opcional):
            <input type="number" name="ano[]" min="1900" max="2100">
        </label>

        <button type="button" onclick="this.parentNode.remove()" style="color:red; margin:5px 0;">
            Remover
        </button>
        <hr>
    `;

          container.appendChild(div);
        }
      </script>
  </main>

</body>

</html>