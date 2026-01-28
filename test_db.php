<?php
// Verifica o conteúdo exato do banco
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;

$db = Database::getInstance();

$sql = "SELECT id_produto, nome_produtos, imagem_produtos FROM tbl_produtos WHERE excluido_em IS NULL LIMIT 5";
$stmt = $db->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
echo "Produtos no banco:\n\n";
foreach ($produtos as $p) {
    echo "ID: " . $p['id_produto'] . " | Nome: " . $p['nome_produtos'] . " | Imagem: '" . ($p['imagem_produtos'] ?? 'NULL') . "'\n";
}
echo "</pre>";
?>
