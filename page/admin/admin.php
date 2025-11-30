<?php
session_start();
include_once '../../sql/conexao.php';

// Se o usuário não estiver logado ou não for admin → mandar embora
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Buscar dados do admin logado
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

// Buscar apoiadores pendentes
$sql_pendentes = $conn->prepare("
    SELECT id, nome, email, imagem
    FROM usuarios 
    WHERE tipo = 'apoiador' AND status_aprovacao = 'pendente'
");
$sql_pendentes->execute();
$pendentes = $sql_pendentes->get_result()->fetch_all(MYSQLI_ASSOC);

// Buscar apoiadores ativos
$sql_ativos = $conn->prepare("
    SELECT id, nome, email, imagem
    FROM usuarios 
    WHERE tipo = 'apoiador' AND status_aprovacao = 'aprovado'
");
$sql_ativos->execute();
$ativos = $sql_ativos->get_result()->fetch_all(MYSQLI_ASSOC);

// Buscar formações
$sql_form = $conn->prepare("
    SELECT f.id, f.usuario_id, f.curso, f.instituicao, f.ano_conclusao 
    FROM formacoes f
");
$sql_form->execute();
$formacoes_raw = $sql_form->get_result()->fetch_all(MYSQLI_ASSOC);

// Reorganizar por usuario_id
$formacoes = [];
foreach ($formacoes_raw as $f) {
    $formacoes[$f['usuario_id']][] = $f;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Aprovação de Apoiadores</title>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/admin.css?v=<?php echo time(); ?>">

    <!-- CSS DO MODAL + AJUSTES (pode mover para admin.css depois) -->
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(3px);
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .modal-content {
            background: #111;
            color: #e0e0e0;
            padding: 25px;
            border-radius: 14px;
            width: 420px;
            animation: popup .25s ease-out;
        }

        @keyframes popup {
            from {
                transform: scale(.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 22px;
            color: #e0e0e0;
        }

        .formacao-card {
            background: #1a1a1a;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 4px solid #e0e0e0;
        }

        .btn-ver-formacoes {
            background: #2d7f2d;
            border: none;
            padding: 8px 14px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 6px;
            color: #fff;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-ver-formacoes:hover {
            background: #3e9e3e;
        }

    </style>
</head>

<body>

    <nav id="menu">
        <div class="menu-center">
            <ul class="menu-list">
                <li><a href="../index.php">Início</a></li>
                <li><a href="../sobre.php">Sobre</a></li>
                <li><a href="../ListaPlantas.php">Lista de plantas</a></li>
                <li><a href="../identificar/identificar.php">Identificar planta</a></li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="../avaliacao.php">Avalie aqui!</a></li>
                <?php endif; ?>
                <li><a href="#" id="active-menu">Painel admin</a></li>
            </ul>
        </div>

        <div class="menu-right">
            <a href="../perfil.php" style="display:flex; align-items:center; gap:10px;">
                <img src="../<?= htmlspecialchars($imagem) ?>" style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                <h5 style="margin:0;"><?= htmlspecialchars($nome) ?></h5>
            </a>
        </div>
    </nav>

    <div class="container">

        <h1 style="color: #196901ff;">Painel do Administrador</h1>

        <!-- APOIADORES PENDENTES -->
        <h2>Apoiadores Pendentes</h2>
        <div class="cards-grid">
            <?php if (empty($pendentes)): ?>
                <p>Nenhum apoiador pendente.</p>
            <?php else: ?>
                <?php foreach ($pendentes as $apoiador): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($apoiador['nome']) ?></h3>
                        <img src="../<?= htmlspecialchars($apoiador['imagem']) ?>" alt="">
                        <p><?= htmlspecialchars($apoiador['email']) ?></p>

                        <button class="btn-ver-formacoes" data-user="<?= $apoiador['id'] ?>">Formações</button>

                        <div class="actions">
                            <a href="../../php/admin/aprovar.php?id=<?= $apoiador['id'] ?>" class="action-btn btn-approve">Aprovar</a>
                            <a href="../../php/admin/excluir.php?id=<?= $apoiador['id'] ?>" class="action-btn btn-delete"
                                onclick="return confirm('Excluir apoiador?');">Excluir</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- APOIADORES ATIVOS -->
        <h2>Apoiadores Ativos</h2>
        <div class="cards-grid">
            <?php if (empty($ativos)): ?>
                <p>Nenhum apoiador ativo.</p>
            <?php else: ?>
                <?php foreach ($ativos as $apoiador): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($apoiador['nome']) ?></h3>
                        <img src="../<?= htmlspecialchars($apoiador['imagem']) ?>" alt="">
                        <p><?= htmlspecialchars($apoiador['email']) ?></p>

                        <button class="btn-ver-formacoes" data-user="<?= $apoiador['id'] ?>">Formações</button>

                        <div class="actions">
                            <a href="../../php/admin/desativar.php?id=<?= $apoiador['id'] ?>" class="action-btn btn-disable">Desativar</a>
                            <a href="../../php/admin/excluir.php?id=<?= $apoiador['id'] ?>" class="action-btn btn-delete"
                                onclick="return confirm('Excluir apoiador?');">Excluir</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- MODAL -->
    <div id="modalFormacoes" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 style="color: #196901ff;">Formações do Apoiador</h3>
            <div id="lista-formacoes"></div>
        </div>
    </div>

    <!-- JS DO MODAL -->
    <script>
        const formacoes = <?= json_encode($formacoes) ?>;
        const modal = document.getElementById("modalFormacoes");
        const lista = document.getElementById("lista-formacoes");
        const closeBtn = document.querySelector(".close");

        document.querySelectorAll(".btn-ver-formacoes").forEach(btn => {
            btn.addEventListener("click", () => {
                const userId = btn.dataset.user;
                lista.innerHTML = "";

                if (!formacoes[userId]) {
                    lista.innerHTML = "<p>Nenhuma formação cadastrada.</p>";
                } else {
                    formacoes[userId].forEach(f => {
                        lista.innerHTML += `
                        <div class="formacao-card">
                            <p><strong>Curso:</strong> ${f.curso}</p>
                            <p><strong>Instituição:</strong> ${f.instituicao}</p>
                            <p><strong>Ano de Conclusão:</strong> ${f.ano_conclusao || "—"}</p>
                        </div>
                    `;
                    });
                }

                modal.style.display = "flex";
            });
        });

        closeBtn.onclick = () => modal.style.display = "none";
        window.onclick = e => { if (e.target === modal) modal.style.display = "none"; };
    </script>
</body>
</html>
