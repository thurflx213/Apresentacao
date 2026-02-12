<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();
echo "--- DEBUG FINAL ---\n";

// 1. Get User ID
$stmt = $db->query("SELECT id_usuarios, nome_usuarios FROM tbl_usuarios WHERE nome_usuarios LIKE '%Arthur%' LIMIT 1");
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Usuario Arthur nao encontrado.");
}
$id_usuario = $user['id_usuarios'];
echo "Usuario: {$user['nome_usuarios']} (ID: $id_usuario)\n";

// 2. Query SEM o NOT IN (Base)
echo "\n--- QUERY BASE (Sem filtro de avaliacoes) ---\n";
$sqlBase = "
    SELECT DISTINCT p.id_produto, p.nome_produtos
    FROM tbl_itens_pedidos ip
    JOIN tbl_pedidos ped ON ip.id_pedido = ped.id_pedido
    JOIN tbl_produtos p ON ip.id_produto = p.id_produto
    JOIN tbl_perfil perf ON ped.id_perfil = perf.id_perfil
    WHERE perf.id_usuarios = :id_usuario
      AND ped.status_pedido IN ('concluido', 'pago', 'Concluido', 'Pago', 'CONCLUIDO', 'PAGO')
      AND ped.excluido_em IS NULL
";

try {
    $stmt = $db->prepare($sqlBase);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Produtos encontrados: " . count($produtos) . "\n";
    foreach($produtos as $prod) {
        echo "- [{$prod['id_produto']}] {$prod['nome_produtos']}\n";
    }
} catch(PDOException $e) {
    echo "ERRO SQL BASE: " . $e->getMessage() . "\n";
}

// 3. Query da Subquery (Avaliacoes)
echo "\n--- SUBQUERY (Avaliacoes do Usuario) ---\n";
$sqlSub = "
    SELECT a.id_produto, a.id_avaliacoes
    FROM tbl_avaliacoes a
    JOIN tbl_perfil perf2 ON a.id_cliente = perf2.id_perfil
    WHERE perf2.id_usuarios = :id_usuario2 
    AND a.excluido_em IS NULL
";

try {
    $stmt = $db->prepare($sqlSub);
    $stmt->bindParam(':id_usuario2', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    $avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Avaliacoes encontradas: " . count($avaliacoes) . "\n";
    foreach($avaliacoes as $av) {
        // Verifica null
        $idProd = $av['id_produto'];
        $nulo = is_null($idProd) ? " (NULL!)" : "";
        echo "- Avaliacao [{$av['id_avaliacoes']}] -> Produto: $idProd$nulo\n";
    }
} catch(PDOException $e) {
    echo "ERRO SQL SUBQUERY: " . $e->getMessage() . "\n";
}
