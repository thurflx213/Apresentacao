<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();

echo "--- DEBUG USERS ---\n";

$sql = "SELECT p.id_perfil, u.nome_usuarios, u.email_usuarios 
        FROM tbl_perfil p 
        JOIN tbl_usuarios u ON p.id_usuario = u.id_usuario";

try {
    foreach($db->query($sql) as $user) {
        echo "Perfil ID: {$user['id_perfil']} | Nome: {$user['nome_usuarios']} ({$user['email_usuarios']})\n";
        
        // Pedidos
        // Removida valor_total_pedido pois pode nao existir
        $sqlPedidos = "SELECT id_pedido, status_pedido FROM tbl_pedidos WHERE id_perfil = {$user['id_perfil']}";
        $pedidos = $db->query($sqlPedidos)->fetchAll(PDO::FETCH_ASSOC);
        echo "  > Pedidos (" . count($pedidos) . "):\n";
        
        foreach($pedidos as $p) {
            $status = $p['status_pedido'];
            // Contar itens
            $stmtItens = $db->query("SELECT count(*) FROM tbl_itens_pedidos WHERE id_pedido = {$p['id_pedido']}");
            $qtdItens = $stmtItens ? $stmtItens->fetchColumn() : 'ERRO';
            echo "    - #{$p['id_pedido']} [$status]: $qtdItens itens.\n";
        }
        echo "\n";
    }
} catch (PDOException $e) {
    echo "ERRO PDO: " . $e->getMessage();
}
echo "--- FIM ---\n";
