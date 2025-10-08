<?php
// Retorna a chave binária (32 bytes) derivada da variável de ambiente APP_KEY
function getEncryptionKey(): string
{
    $appKey = getenv('APP_KEY'); // definir em .env ou no ambiente do servidor
    if (!$appKey) {
        // Em desenvolvimento só: substitua com sua chave segura. NÃO deixe isso em produção.
        throw new RuntimeException('Chave de criptografia não definida. Defina APP_KEY no ambiente.');
    }
    // Se APP_KEY estiver em hex (64 chars) -> converte para binário; senão, faz hash.
    if (ctype_xdigit($appKey) && strlen($appKey) === 64) {
        return hex2bin($appKey);
    }
    // Garante 32 bytes (256 bits)
    return hash('sha256', $appKey, true);
}

function encryptCPF(string $cpf): string
{
    // limpa para apenas números
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) !== 11) {
        throw new InvalidArgumentException('CPF deve conter 11 dígitos.');
    }

    $key = getEncryptionKey();
    $iv = openssl_random_pseudo_bytes(16); // 16 bytes para AES-256-CBC
    $ciphertext = openssl_encrypt($cpf, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    // HMAC para integridade (sha256 -> 32 bytes binários)
    $hmac = hash_hmac('sha256', $iv . $ciphertext, $key, true);

    // Armazene base64(iv + hmac + ciphertext)
    return base64_encode($iv . $hmac . $ciphertext);
}

function decryptCPF(string $payload)
{
    $key = getEncryptionKey();
    $decoded = base64_decode($payload, true);
    if ($decoded === false || strlen($decoded) < 48) { // iv(16) + hmac(32) = 48
        return false;
    }

    $iv = substr($decoded, 0, 16);
    $hmac = substr($decoded, 16, 32);
    $ciphertext = substr($decoded, 48);

    // verifica HMAC com hash_equals para evitar timing attacks
    $calculated = hash_hmac('sha256', $iv . $ciphertext, $key, true);
    if (!hash_equals($hmac, $calculated)) {
        return false; // integridade falhou
    }

    $plain = openssl_decrypt($ciphertext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    if ($plain === false) return false;
    return $plain; // string com 11 dígitos do CPF
}
?>
