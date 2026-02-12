<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();
echo "--- DEBUG BASE ONLY ---\n";

// 1. Get User
$stmt = $db->query("SELECT id_usuarios FROM tbl_usuarios WHERE nome_usuarios LIKE '%Arthur%' LIMIT 1");
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$id_usuario = $user['id_usuarios'];
echo "Usuario ID: $id_usuario\n";

// 2. Query Base
$sql = "
    SELECT DISTINCT p.id_produto, p.nome_produtos
    FROM tbl_itens_pedidos ip
    JOIN tbl_pedidos ped ON ip.id_pedido = ped.id_pedido
    JOIN tbl_produtos p ON ip.id_produto = p.id_produto
    JOIN tbl_perfil perf ON ped.id_perfil = perf.id_perfil
    WHERE perf.id_usuarios = :id_usuario
      AND ped.status_pedido IN ('concluido', 'pago', 'Concluido', 'Pago', 'CONCLUIDO', 'PAGO')
      AND ped.excluido_em IS NULL
";

$stmt = $db->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Produtos (Base): " . count($produtos) . "\n";
foreach($produtos as $p) {
    echo "- [{$p['id_produto']}] {$p['nome_produtos']}\n";
}
