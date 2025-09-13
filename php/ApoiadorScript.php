<?php
// DEV: mostrar erros (remova em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Requisição inválida. Use POST.');
    }

    // inclua seu arquivo de conexão (que deve definir $conn como mysqli)
    include_once 'conexao.php';

    // Se $conn não existir ou não for mysqli, tenta conexão padrão (ajuste user/pass/db)
    if (!isset($conn) || !($conn instanceof mysqli)) {
        $conn = new mysqli('localhost', 'root', '', 'bd'); // ajuste conforme seu ambiente
    }
    if ($conn->connect_error) {
        throw new Exception('Erro de conexão: ' . $conn->connect_error);
    }

    // --- ler e sanitizar dados ---
    $nome    = trim($_POST['nome'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $cpf     = preg_replace('/\D/', '', $_POST['cpf'] ?? ''); // só números
    $emprego = trim($_POST['emprego'] ?? '');
    $senha   = $_POST['senha'] ?? '';
    $imagem  = null; // caminho relativo salvo no banco (ou null se não enviado)

    // --- validação básica ---
    if ($nome === '' || $email === '' || $cpf === '' || $senha === '') {
        throw new Exception('Preencha os campos obrigatórios: nome, email, CPF e senha.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Email inválido.');
    }

    // --- upload de imagem (opcional) ---
    if (!empty($_FILES['imagem']['name']) && isset($_FILES['imagem'])) {
        if ($_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Erro no upload da imagem: ' . $_FILES['imagem']['error']);
        }

        $maxSize = 2 * 1024 * 1024; // 2 MB
        if ($_FILES['imagem']['size'] > $maxSize) {
            throw new Exception('Imagem muito grande (máx 2MB).');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($_FILES['imagem']['tmp_name']);
        $allowed = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];
        if (!isset($allowed[$mime])) {
            throw new Exception('Tipo de imagem não permitido. Use JPG, PNG ou WEBP.');
        }

        $ext = $allowed[$mime];
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $fileName = uniqid('ap_') . '.' . $ext;
        $destPath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destPath)) {
            throw new Exception('Falha ao mover o arquivo enviado.');
        }

        // salvo caminho relativo para uso no site
        $imagem = 'uploads/' . $fileName;
    }

    // --- hash da senha ---
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // --- preparar e executar INSERT ---
    $sql = "INSERT INTO apoiador (nome, email, cpf, emprego, imagem, senha) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        throw new Exception('Erro no prepare SQL: ' . $conn->error);
    }

    $stmt->bind_param('ssssss', $nome, $email, $cpf, $emprego, $imagem, $senhaHash);
    if (!$stmt->execute()) {
        throw new Exception('Erro ao executar query: ' . $stmt->error);
    }

    echo json_encode(['status' => 'success', 'message' => 'Apoiador cadastrado com sucesso.']);
    $stmt->close();
    $conn->close();
    exit;

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}
