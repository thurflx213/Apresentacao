<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();

echo "--- DEBUG ITENS ---\n";

// 1. Pega usuário
$sql = "SELECT DISTINCT p.id_perfil FROM tbl_pedidos p WHERE p.status_pedido IN ('concluido', 'pago', 'CONCLUIDO', 'PAGO') LIMIT 1";
$stmt = $db->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_perfil = $row['id_perfil'];
echo "Perfil ID: $id_perfil\n";

// 2. Pedidos
$sql = "SELECT id_pedido, status_pedido FROM tbl_pedidos WHERE id_perfil = $id_perfil";
foreach($db->query($sql) as $p) {
    echo "Pedido #{$p['id_pedido']} ({$p['status_pedido']})\n";
    
    // 3. Itens
    $sqlItens = "SELECT count(*) as qtd FROM tbl_itens_pedidos WHERE id_pedido = {$p['id_pedido']}";
    $qtd = $db->query($sqlItens)->fetchColumn();
    echo "  > Itens encontrados: $qtd\n";
    
    if ($qtd > 0) {
        $sqlProd = "SELECT id_produto FROM tbl_itens_pedidos WHERE id_pedido = {$p['id_pedido']}";
        foreach($db->query($sqlProd) as $item) {
            echo "    - Produto ID: {$item['id_produto']}\n";
            
            // Check Produtos
            $exists = $db->query("SELECT count(*) FROM tbl_produtos WHERE id_produto = {$item['id_produto']}")->fetchColumn();
            echo "      > Existe na tbl_produtos? " . ($exists ? 'SIM' : 'NAO') . "\n";
        }
    }
}
echo "--- FIM ---\n";
