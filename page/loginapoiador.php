
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login do Apoiador | Botan Mind</title>
  <link rel="stylesheet" href="../css/style.css?v=1" />
  <link rel="shortcut icon" href="https://images.vexels.com/media/users/3/262042/isolated/preview/69326c8749e7a0bc882fbbe2a8e5fa50-icone-botanico-de-folha.png" type="image/png">
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
    <div class="form-apoiador" style="max-width:400px; margin:60px auto;">
      <h2 class="h2c">Login do Apoiador</h2>
      <form action="../php/loginapoiador.php" method="post">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required autocomplete="username">

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required autocomplete="current-password">

        <button type="submit" class="btn_cadastro" style="width:100%;">Entrar</button>
      </form>
      <hr>
      <p style="text-align:center; margin-top:10px;">
        Ainda não é apoiador? <a href="cadastroapoiador.php" style="color:#1c7924;">Cadastre-se aqui</a>
      </p>
    </div>
  </main>


</body>
<script src="../js/index.js?v