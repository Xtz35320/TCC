<?php
include_once '../sql/conexao.php';
session_start();

/* ================================
      CONFIGURAÇÃO DE PAGINAÇÃO
   ================================ */
$plantas_por_pagina = 12;
$pagina_atual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $plantas_por_pagina;

$busca = isset($_GET['q']) ? trim($_GET['q']) : "";
$tagFiltro = isset($_GET['tag']) ? (int) $_GET['tag'] : 0;

/* ================================
      FILTRO DE PLANTAS (BUSCA)
   ================================ */
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
        SELECT p.id, p.nome_popular, p.descricao,
               (SELECT caminho_imagem FROM imagens WHERE planta_id = p.id LIMIT 1) AS caminho_imagem
        FROM planta p
        WHERE $where
        ORDER BY p.nome_popular ASC
        LIMIT $plantas_por_pagina OFFSET $offset
    ";

    $sql_total = "SELECT COUNT(*) AS total FROM planta p WHERE $where";
} else {
    $sql = "
        SELECT p.id, p.nome_popular, p.descricao,
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

/* ================================
      LOGOUT
   ================================ */
if (isset($_POST['logout'])) {
    unset($_SESSION['usuario_id']);
    unset($_SESSION['usuario_nome']);
    unset($_SESSION['usuario_tipo']);
    session_destroy();
    header("Location: index.php");
    exit;
}

/* ================================
      BUSCAR DADOS DO USUÁRIO
   ================================ */
if (!isset($_SESSION['usuario_id'])) {
    $usuario_id = null;
    $nome = $imagem = $cpf = $email = "";
} else {
    $id = $_SESSION['usuario_id'];

    $sql_user = "SELECT id, nome, imagem, cpf, email FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql_user);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result_user = $stmt->get_result();

    if ($result_user->num_rows > 0) {
        $row = $result_user->fetch_assoc();
        $usuario_id = $row['id'];
        $nome = $row['nome'];
        $imagem = $row['imagem'];
        $cpf = $row['cpf'];
        $email = $row['email'];
    } else {
        $usuario_id = null;
    }

    $stmt->close();
}

/* ================================
      FORMATAR CPF
   ================================ */
function formatarCPF($cpf)
{
    $cpf = preg_replace('/\D/', '', (string)$cpf);
    if (strlen($cpf) !== 11) return '';
    return substr($cpf, 0, 3) . str_repeat('*', 6) . substr($cpf, -2);
}

/* ================================
      BUSCAR PLANTAS DO USUÁRIO
   ================================ */
$plantas = [];

if (isset($usuario_id)) {
    $sql_planta = "
        SELECT p.id, p.nome_popular, p.descricao, MIN(i.caminho_imagem) AS caminho_imagem
        FROM planta p
        LEFT JOIN imagens i ON i.planta_id = p.id
        WHERE p.usuario_id = ?
        GROUP BY p.id, p.nome_popular, p.descricao
    ";

    $stmt2 = $conn->prepare($sql_planta);
    $stmt2->bind_param("i", $usuario_id);
    $stmt2->execute();
    $result_planta = $stmt2->get_result();

    while ($row = $result_planta->fetch_assoc()) {
        $plantas[] = $row;
    }

    $stmt2->close();
}

/* ================================
      BUSCAR FORMAÇÕES (CORRIGIDO)
   ================================ */
$formacoes = [];
$sql_form = $conn->prepare("SELECT * FROM formacoes WHERE usuario_id = ?");
$sql_form->bind_param("i", $usuario_id);
$sql_form->execute();
$res_form = $sql_form->get_result();

while ($f = $res_form->fetch_assoc()) {
    $formacoes[] = $f;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Botan Mind | Perfil</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <nav id="menu">
        <div class="menu-center">
            <ul class="menu-list">
                <li><a href="index.php">Início</a></li>

                <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_tipo'] === "apoiador"): ?>
                    <li><a href="cadastro.php">Cadastro de plantas</a></li>
                <?php endif; ?>

                <li><a href="ListaPlantas.php">Lista de plantas</a></li>
                <li><a href="./identificar/identificar.php">Identificar planta</a></li>

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="avaliacao.php">Avalie aqui!</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_tipo'] === "admin"): ?>
                    <li><a href="./admin/admin.php">Painel admin</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <section class="perfil-container">
        <div class="perfil-card">
            <img src="<?php echo htmlspecialchars($imagem ?: '../img/default-user.png'); ?>" class="perfil-foto">

            <div class="perfil-info">
                <h2><?php echo htmlspecialchars($nome); ?></h2>
                <p><strong>CPF:</strong> <?php echo formatarCPF($cpf); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            </div>

            <div class="perfil-acoes">
                <form method="post">
                    <button class="btn_deslogar" type="submit" name="logout">Sair</button>
                </form>
            </div>
        </div>


        <!-- ====================== -->
        <!--       FORMAÇÕES        -->
        <!-- ====================== -->

        <div class="formacao-container">
            <h3 style="margin-top:20px;">Formações</h3>

            <?php if (count($formacoes) === 0): ?>
                <p>Nenhuma formação cadastrada.</p>
            <?php endif; ?>

            <?php foreach ($formacoes as $f): ?>
                <div class="formacao-card">
                    <h4 style="color: #246b37;"><?= htmlspecialchars($f['curso']) ?></h4>

                    <p><b>Instituição:</b> <?= htmlspecialchars($f['instituicao']) ?></p>

                    <?php if (!empty($f['ano_conclusao'])): ?>
                        <p><b>Ano de conclusão:</b> <?= htmlspecialchars($f['ano_conclusao']) ?></p>
                    <?php endif; ?>

                    <a class="btn-del"
                        href="../php/formacao/excluir_formacao.php?id=<?= $f['id'] ?>"
                        onclick="return confirm('Deseja excluir esta formação?');">
                        Excluir
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </section>


    <?php if (isset($_SESSION['usuario_id']) && ($_SESSION['usuario_tipo'] === 'apoiador' || $_SESSION['usuario_tipo'] === 'admin')): ?>

        <main class="listar-container">

            <h2 class="titulo-listar" style="margin-top: 100px;">Plantas publicadas</h2>

            <div class="listar-grid">
                <?php if (count($plantas) > 0): ?>
                    <?php foreach ($plantas as $planta): ?>
                        <a href="template_page.php?id=<?= $planta['id'] ?>" class="listar-card">
                            <img src="<?= htmlspecialchars($planta['caminho_imagem']) ?>" class="listar-card-img">
                            <div class="listar-card-content">
                                <h3><?= htmlspecialchars($planta['nome_popular']) ?></h3>
                                <p class="texto"
                                    style="display:-webkit-box; -webkit-line-clamp:6; -webkit-box-orient:vertical; overflow:hidden;">
                                    <?= htmlspecialchars($planta['descricao']) ?>
                                </p>
                                <span class="read-more-btn">Leia Mais</span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nenhuma planta cadastrada.</p>
                <?php endif; ?>
            </div>

            <?php if ($total_paginas > 1): ?>
                <div class="paginacao">
                    <?php if ($pagina_atual > 1): ?>
                        <a href="?pagina=<?= $pagina_atual - 1 ?>">« Anterior</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <a href="?pagina=<?= $i ?>" class="<?= $i === $pagina_atual ? 'ativo' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($pagina_atual < $total_paginas): ?>
                        <a href="?pagina=<?= $pagina_atual + 1 ?>">Próxima »</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </main>

    <?php endif; ?>

</body>
<style>
    body {
        padding-top: 100px;
    }
</style>

</html>