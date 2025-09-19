<?php
// Habilitar exibição de erros para debug (remover em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurações de conexão com o banco de dados
include_once "../sql/conexao.php"; // Aqui assumimos que a variável $conn é a conexão MySQLi.

$uf_to_id = [
    'AC' => 1, 'AL' => 2, 'AM' => 4, 'AP' => 3, 'BA' => 5, 
    'CE' => 6, 'DF' => 7, 'ES' => 8, 'GO' => 9, 'MA' => 10, 
    'MG' => 13, 'MS' => 12, 'MT' => 11, 'PA' => 14, 'PB' => 15, 
    'PE' => 17, 'PI' => 18, 'PR' => 16, 'RJ' => 19, 'RN' => 20, 
    'RO' => 22, 'RR' => 23, 'RS' => 21, 'SC' => 24, 'SE' => 26, 
    'SP' => 25, 'TO' => 27
];

try {
    // Verificar se a conexão foi estabelecida com sucesso
    if (!$conn) {
        throw new Exception('Erro na conexão com o banco de dados.');
    }

    // Verificar se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Validar e sanitizar dados do formulário
        $nome_popular = filter_input(INPUT_POST, 'nome_popular');
        $nome_cientifico = filter_input(INPUT_POST, 'nome_cientifico');
        $descricao = filter_input(INPUT_POST, 'descricao');
        $cuidados = filter_input(INPUT_POST, 'cuidados');
        $video_link = filter_input(INPUT_POST, 'video_link', FILTER_SANITIZE_URL);
        
        // Dados taxonômicos
        $reino = filter_input(INPUT_POST, 'reino');
        $divisao = filter_input(INPUT_POST, 'divisao');
        $classe = filter_input(INPUT_POST, 'classe');
        $ordem = filter_input(INPUT_POST, 'ordem');
        $familia = filter_input(INPUT_POST, 'familia');
        $genero = filter_input(INPUT_POST, 'genero');
        $especie = filter_input(INPUT_POST, 'especie');
        
        // Estados selecionados - agora serão armazenados como IDs
        $estados_ids = [];
        if (!empty($_POST['estados'])) {
            $estados_uf = explode(',', $_POST['estados']);
            
            foreach ($estados_uf as $uf) {
                $uf_clean = strtoupper(trim($uf));
                if (isset($uf_to_id[$uf_clean])) {
                    $estados_ids[] = $uf_to_id[$uf_clean];
                }
            }
        }
        
        // Validar campos obrigatórios
        if (empty($nome_popular) || empty($nome_cientifico) || empty($descricao) || empty($cuidados)) {
            throw new Exception('Todos os campos obrigatórios devem ser preenchidos.');
        }
        
        // Iniciar transação
        $conn->begin_transaction();
        
        // 1. Inserir dados básicos da planta
        $stmt = $conn->prepare("INSERT INTO planta (nome_popular, nome_cientifico, descricao, cuidados, video_link) 
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nome_popular, $nome_cientifico, $descricao, $cuidados, $video_link);
        $stmt->execute();
        
        $planta_id = $stmt->insert_id;
        
        // 2. Inserir características taxonômicas
        $stmt = $conn->prepare("INSERT INTO caracteristicas (planta_id, reino, divisao, classe, ordem, familia, genero, especie) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $planta_id, $reino, $divisao, $classe, $ordem, $familia, $genero, $especie);
        $stmt->execute();
        
        // 3. Inserir relação planta-estado usando IDs
        if (!empty($estados_ids)) {
            $stmt = $conn->prepare("INSERT INTO planta_estado (id_planta, id_estado) VALUES (?, ?)");
            
            foreach ($estados_ids as $estado_id) {
                $stmt->bind_param("ii", $planta_id, $estado_id);
                $stmt->execute();
            }
        }
        
        // 4. Processar upload de imagens
        if (!empty($_FILES['imagem']['name'][0])) {
            $upload_dir = '../assets/img/';
            
            foreach ($_FILES['imagem']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['imagem']['error'][$key] === UPLOAD_ERR_OK) {
                    $file_name = basename($_FILES['imagem']['name'][$key]);
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    
                    if (in_array($file_ext, $allowed_ext)) {
                        $new_file_name = $file_name;
                        $file_path = $upload_dir . $new_file_name;
                        
                        if (move_uploaded_file($tmp_name, $file_path)) {
                            $stmt = $conn->prepare("INSERT INTO imagens (planta_id, caminho_imagem, descricao) 
                                                   VALUES (?, ?, ?)");
                            $descricao_imagem = 'Imagem de ' . $nome_popular;
                            $stmt->bind_param("iss", $planta_id, $file_path, $descricao_imagem);
                            $stmt->execute();
                        }
                    }
                }
            }
        }
        
        // 5. Processar upload de documento
        if (!empty($_FILES['documento']['name'])) {
            $upload_dir = '../assets/documentos/';
            
            if ($_FILES['documento']['error'] === UPLOAD_ERR_OK) {
                $file_name = basename($_FILES['documento']['name']);
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                if ($file_ext === 'pdf') {
                    $new_file_name = $file_name;
                    $file_path = $upload_dir . $new_file_name;
                    
                    if (move_uploaded_file($_FILES['documento']['tmp_name'], $file_path)) {
                        $tipo_documento = filter_input(INPUT_POST, 'tipo_documento');
                        $titulo_documento = filter_input(INPUT_POST, 'titulo_documento');
                        
                        $stmt = $conn->prepare("INSERT INTO documentos (planta_id, tipo, titulo, link_pdf) 
                                               VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("isss", $planta_id, $tipo_documento, $titulo_documento, $file_path);
                        $stmt->execute();
                    }
                }
            }
        }
        
        // Confirmar transação
        $conn->commit();
        
        // Redirecionar com mensagem de sucesso
        header('Location: cadastro.php?success=1');
        exit;
        
    } else {
        throw new Exception('Método de requisição inválido.');
    }
    
} catch (Exception $e) {
    // Reverter transação em caso de erro
    if ($conn->connect_error) {
        $conn->rollback();
    }
    
    // Redirecionar com mensagem de erro
    header('Location: ../page/cadastro.php?error=' . urlencode($e->getMessage()));
    exit;
}
?>
