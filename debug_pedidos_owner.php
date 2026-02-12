<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();

echo "--- DEBUG PEDIDOS 3 e 4 ---\n";

$ids = [3, 4];
foreach($ids as $id) {
    $stmt = $db->query("SELECT * FROM tbl_pedidos WHERE id_pedido = $id");
    $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($pedido) {
        echo "Pedido #$id ENCONTRADO:\n";
        echo "  - Status: {$pedido['status_pedido']}\n";
        echo "  - ID Perfil: {$pedido['id_perfil']}\n";
        
        // Quem é o dono?
        $stmtP = $db->query("SELECT * FROM tbl_perfil WHERE id_perfil = {$pedido['id_perfil']}");
        $perfil = $stmtP->fetch(PDO::FETCH_ASSOC);
        echo "  - Dono (Perfil): ID {$perfil['id_perfil']}\n";
        
        // Usuario
        $idUser = $perfil['id_usuario'] ?? $perfil['id_usuarios']; // Tentando ambas colunas
        $stmtU = $db->query("SELECT * FROM tbl_usuarios WHERE id_usuarios = $idUser"); // Usar id_usuarios (com s) na tabela usuarios
        $user = $stmtU->fetch(PDO::FETCH_ASSOC);
        echo "  - Usuario: {$user['nome_usuarios']} (ID: {$user['id_usuarios']})\n";
    } else {
        echo "Pedido #$id NAO ENCONTRADO no banco!\n";
    }
    echo "\n";
}
