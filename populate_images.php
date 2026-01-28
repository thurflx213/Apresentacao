<?php
// Popula alguns produtos com imagens (para teste)
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;

$db = Database::getInstance();

// Lista de imagens que existem no disco
$imagensDisco = [
    '6900abceb435f8.98440033.jpg',
    '6900ac63801208.98490339.jpg',
    '6900ace46ffe59.66810689.jpg',
];

// Busca os primeiros 3 produtos
$stmt = $db->query("SELECT id_produto FROM tbl_produtos WHERE excluido_em IS NULL LIMIT 3");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Atualizando " . count($produtos) . " produtos com imagens...<br><br>";

$count = 0;
foreach ($produtos as $idx => $produto) {
    $id = $produto['id_produto'];
    $imagem = $imagensDisco[$idx % count($imagensDisco)];
    
    $updateStmt = $db->prepare("UPDATE tbl_produtos SET imagem_produtos = :imagem WHERE id_produto = :id");
    $updateStmt->bindParam(':imagem', $imagem);
    $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($updateStmt->execute()) {
        echo "✓ Produto #" . $id . " atualizado com imagem: " . $imagem . "<br>";
        $count++;
    } else {
        echo "✗ ERRO ao atualizar produto #" . $id . "<br>";
    }
}

echo "<br>Total atualizado: " . $count . " produto(s)<br>";
echo "<a href='/produto.php'>Ver produtos</a>";
?>
