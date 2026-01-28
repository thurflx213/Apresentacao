<?php
// Debug: Verifica se produtos estão sendo carregados
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;
use App\Koketsu\Models\Produtos;

$db = Database::getInstance();
$produtosModel = new Produtos($db);
$produtos = $produtosModel->buscarProdutosAtivos();

echo "<pre>";
echo "Total de produtos: " . count($produtos) . "\n\n";

if (is_array($produtos) && count($produtos) > 0) {
    echo "Primeiros 3 produtos:\n";
    for ($i = 0; $i < min(3, count($produtos)); $i++) {
        echo "\nProduto " . ($i + 1) . ":\n";
        echo "  ID: " . ($produtos[$i]['id_produto'] ?? 'NULL') . "\n";
        echo "  Nome: " . ($produtos[$i]['nome_produtos'] ?? 'NULL') . "\n";
        echo "  Imagem: " . ($produtos[$i]['imagem_produtos'] ?? 'NULL') . "\n";
        echo "  Preço: " . ($produtos[$i]['preco_produtos'] ?? 'NULL') . "\n";
    }
} else {
    echo "ERRO: Nenhum produto encontrado ou erro na query!\n";
}

echo "</pre>";
?>
