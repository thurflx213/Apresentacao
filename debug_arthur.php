<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();

echo "--- DEBUG ARTHUR ---\n";

// 1. Buscar Usuario Arthur
$stmt = $db->query("SELECT * FROM tbl_usuarios WHERE nome_usuarios LIKE '%Arthur%'");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($users as $user) {
    echo "Usuario: {$user['nome_usuarios']} (ID: {$user['id_usuarios']})\n";
    
    // 2. Buscar Perfil
    // Tenta achar FK. Se nao achar id_usuario, tenta id_usuarios
    try {
        $stmtP = $db->query("SELECT * FROM tbl_perfil WHERE id_usuario = {$user['id_usuarios']}");
    } catch (Exception $e) {
        $stmtP = $db->query("SELECT * FROM tbl_perfil WHERE id_usuarios = {$user['id_usuarios']}");
    }
    
    $perfil = $stmtP->fetch(PDO::FETCH_ASSOC);
    
    if (!$perfil) {
        echo "  > Perfil nao encontrado!\n";
        continue;
    }
    
    echo "  > Perfil ID: {$perfil['id_perfil']}\n";
    
    // 3. Buscar Pedidos
    $stmtPed = $db->query("SELECT id_pedido, status_pedido FROM tbl_pedidos WHERE id_perfil = {$perfil['id_perfil']}");
    $pedidos = $stmtPed->fetchAll(PDO::FETCH_ASSOC);
    
    echo "  > Pedidos (" . count($pedidos) . "):\n";
    foreach($pedidos as $p) {
        echo "    - #{$p['id_pedido']} [{$p['status_pedido']}]\n";
        
        // 4. Itens
        $stmtItens = $db->query("SELECT * FROM tbl_itens_pedidos WHERE id_pedido = {$p['id_pedido']}");
        $itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);
        echo "      > Itens: " . count($itens) . "\n";
        foreach($itens as $i) {
            echo "        - Produto ID: {$i['id_produto']}\n";
        }
    }
    
    // 5. Avaliacoes
    // Id_cliente em avaliacoes refere a id_perfil ou id_usuario? (Assumindo id_perfil conforme codigo)
    $stmtAv = $db->query("SELECT * FROM tbl_avaliacoes WHERE id_cliente = {$perfil['id_perfil']}");
    $avaliacoes = $stmtAv->fetchAll(PDO::FETCH_ASSOC);
    echo "  > Avaliacoes (por ID Perfil): " . count($avaliacoes) . "\n";
}
