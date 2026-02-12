<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;
use App\Koketsu\Models\Pedidos;

$db = Database::getInstance();
echo "--- TESTE FINAL ---\n";

// 1. Get User ID
$stmt = $db->query("SELECT id_usuarios, nome_usuarios FROM tbl_usuarios WHERE nome_usuarios LIKE '%Arthur%' LIMIT 1");
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Usuario Arthur nao encontrado.");
}
$id_usuario = $user['id_usuarios'];
echo "Usuario: {$user['nome_usuarios']} (ID: $id_usuario)\n";

// 2. Testar Model
echo "\n--- Testando Pedidos::buscarProdutosCompradosPorUsuario ---\n";
try {
    $pedidosModel = new Pedidos($db);
    $produtos = $pedidosModel->buscarProdutosCompradosPorUsuario($id_usuario);
    
    echo "Produtos encontrados: " . count($produtos) . "\n";
    foreach($produtos as $prod) {
        echo "- [{$prod['id_produto']}] {$prod['nome_produtos']}\n";
    }
} catch (Exception $e) {
    echo "ERRO: " . $e->getMessage() . "\n";
}
echo "--- FIM ---\n";
