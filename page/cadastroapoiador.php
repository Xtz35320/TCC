<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro de Apoiador | Botan Mind</title>
  <link rel="stylesheet" href="../css/style.css?v=1" />
</head>

<body>
  <nav id="menu">
    <ul class="menu-list">
      <li><a href="./index.php">Início</a></li>
      <li><a href="#about">Sobre</a></li>
      <li><a href="./ListaPlantas.php">Lista de plantas</a></li>
    </ul>
  </nav>


  <main style="margin-top:80px; min-height:60vh;">
    <div class="form-apoiador" style="max-width:500px; margin:60px auto;">
      <h2 class="h2c">Cadastro de Apoiador</h2>

      <?php
      include_once '../sql/conexao.php';

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $emprego = $_POST['emprego'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $imagem = '';
        $tipo = 3;

        // Upload da imagem
        if (!empty($_FILES['imagem']['name'])) {
          $pasta = 'uploads/';
          if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
          }
          $nomeArquivo = uniqid() . '_' . basename($_FILES['imagem']['name']);
          $caminhoDestino = $pasta . $nomeArquivo;

          if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
            $imagem = $caminhoDestino;
          }
        }

        // Criptografa a senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);


        $sql = "INSERT INTO usuarios (nome, email, cpf, imagem, senha, tipo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $nome, $email, $cpf, $imagem, $senhaHash, $tipo);

        if ($stmt->execute()) {
          echo "<p style='color:green; text-align:center;'>Apoiador cadastrado com sucesso!</p>";
        } else {
          echo "<p style='color:red; text-align:center;'>Erro ao cadastrar: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
      }
      ?>

      <form class="form-login" action="" method="POST" enctype="multipart/form-data">
        <label>Nome: <input type="text" name="nome" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>CPF: <input type="text" name="cpf" required  maxlength="11"></label><br>
        <label>Formação: <input type="text" name="emprego"></label><br>
        <label>Senha: <input type="password" name="senha" minlength="8" required></label><br>
        <label>Imagem (opcional): <input type="file" name="imagem" accept="image/*"></label><br>
        <button type="submit" class="btn_cadastro" style="width:100%;">Cadastrar</button>
      </form>

      <hr>
      <p style="text-align:center; margin-top:10px;">
        Já é apoiador? <a href="login.php" style="color:#1c7924;">Faça login</a>
      </p>
    </div>
  </main>
</body>


</html>