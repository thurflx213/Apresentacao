<?php
// Popula TODOS os produtos com imagens do disco
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;

$db = Database::getInstance();

// Lista todas as imagens que existem no disco
$imageDir = __DIR__ . '/backend/upload/produtos';
$imagensDisco = [];
if (is_dir($imageDir)) {
    $files = scandir($imageDir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && is_file($imageDir . '/' . $file)) {
            $imagensDisco[] = $file;
        }
    }
}

echo "Encontradas " . count($imagensDisco) . " imagens no disco<br>";

if (count($imagensDisco) == 0) {
    echo "ERRO: Nenhuma imagem encontrada em /backend/upload/produtos/<br>";
    exit;
}

// Busca TODOS os produtos
$stmt = $db->query("SELECT id_produto FROM tbl_produtos WHERE excluido_em IS NULL ORDER BY id_produto");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Atualizando " . count($produtos) . " produtos com imagens...<br><br>";

$count = 0;
foreach ($produtos as $idx => $produto) {
    $id = $produto['id_produto'];
    $imagem = $imagensDisco[$idx % count($imagensDisco)];  // Distribui as imagens disponíveis
    
    $updateStmt = $db->prepare("UPDATE tbl_produtos SET imagem_produtos = :imagem WHERE id_produto = :id");
    $updateStmt->bindParam(':imagem', $imagem);
    $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($updateStmt->execute()) {
        echo "✓ #" . str_pad($id, 2, "0", STR_PAD_LEFT) . " => " . $imagem . "<br>";
        $count++;
    } else {
        echo "✗ Erro ao atualizar #" . $id . "<br>";
    }
}

echo "<br><strong>Total atualizado: " . $count . " produto(s)</strong><br>";
echo "<a href='http://localhost:8000/produto.php' target='_blank'>👉 Ver produtos agora</a>";
?>
