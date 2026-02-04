<?php
// Simular a requisição para a API
require_once 'backend/Database/database.php';
require_once 'vendor/autoload.php';

use App\Koketsu\Database\Database;

$db = Database::getInstance();

// Testar a query do getPedidos
$page = 1;
$registros_por_pagina = 10;
$offset = ($page - 1) * $registros_por_pagina;

try {
    $sqlCount = "SELECT COUNT(*) as total FROM tbl_pedidos WHERE excluido_em IS NULL";
    $stmtCount = $db->prepare($sqlCount);
    $stmtCount->execute();
    $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
    
    echo "Total de pedidos: " . $total . "\n";
    
    $sql = "SELECT p.id_pedido, p.id_perfil, p.data_pedido, p.total_pedido, p.status_pedido, p.criado_em, p.atualizado_em, pf.id_usuarios 
            FROM tbl_pedidos p 
            LEFT JOIN tbl_perfil pf ON p.id_perfil = pf.id_perfil 
            WHERE p.excluido_em IS NULL 
            LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
    
    echo "\nQuery: " . $sql . "\n";
    
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $pedidos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
    echo "\nPedidos encontrados: " . count($pedidos) . "\n";
    echo json_encode(['status' => 'success', 'data' => $pedidos], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
