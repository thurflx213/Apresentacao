<?php
// Query direta ao banco
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;

try {
    $db = Database::getInstance();
    $stmt = $db->query("SELECT COUNT(*) as total FROM tbl_produtos WHERE excluido_em IS NULL");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Total de produtos ativos: " . $result['total'] . "<br><br>";
    
    $stmt = $db->query("SELECT id_produto, nome_produtos, imagem_produtos FROM tbl_produtos WHERE excluido_em IS NULL LIMIT 3");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1'><tr><th>ID</th><th>Nome</th><th>Imagem (banco)</th></tr>";
    foreach ($produtos as $p) {
        echo "<tr>";
        echo "<td>" . $p['id_produto'] . "</td>";
        echo "<td>" . $p['nome_produtos'] . "</td>";
        echo "<td>" . ($p['imagem_produtos'] ?? 'NULL/VAZIO') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} catch (Exception $e) {
    echo "ERRO: " . $e->getMessage();
}
?>
