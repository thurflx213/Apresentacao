<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;
use App\Koketsu\Models\Produtos;

try {
    // Obter conexão com o banco de dados
    $db = Database::getInstance();
    
    // Criar instância do modelo de produtos
    $produtosModel = new Produtos($db);
    
    // Buscar produtos do banco com suas categorias
    $produtos_db = $produtosModel->buscarProdutosAtivosComCategoria();
    
    if (empty($produtos_db)) {
        http_response_code(200);
        echo json_encode([], JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // Formatar os produtos para o formato esperado pelo frontend
    $categorias_organizadas = [];
    $imagem_padrao = "img/default.png";
    
    // Definir ordem das categorias
    $ordem_categorias = [
        'Camisetas',
        'Calças',
        'Jaquetas',
        'Tênis',
        'Acessórios',
        'Bermudas',
        'Macacões'
    ];
    
    // Mapear categorias do banco para nomes corretos
    $mapa_categorias = [
        'Bermudas' => 'Camisas',
        'Macacões' => 'Beachwear',
        'Tênis' => 'Bermudas e Shorts'
    ];
    
    foreach ($produtos_db as $produto) {
        $nome_categoria = $produto['nome_categoria'] ?? 'OUTROS';
        
        // Renomear categoria se estiver no mapa
        if (isset($mapa_categorias[$nome_categoria])) {
            $nome_categoria = $mapa_categorias[$nome_categoria];
        }
        
        $tag_categoria = '';

        if (!isset($categorias_organizadas[$nome_categoria])) {
            $categorias_organizadas[$nome_categoria] = [
                'categoria' => $nome_categoria,
                'tag' => $tag_categoria,
                'itens' => []
            ];
        }

        $nome_imagem_bd = trim($produto['imagem_produtos'] ?? '');
        $caminho_imagem = $imagem_padrao;
        
        if (!empty($nome_imagem_bd) && $nome_imagem_bd !== 'NULL') {
            $caminho_limpo = str_replace('\\', '/', $nome_imagem_bd);
            $caminho_limpo = preg_replace('/^(img\/|produtos\/)/i', '', $caminho_limpo);
            
            if (!empty($caminho_limpo)) {
                $caminho_imagem = "img/" . $caminho_limpo;
            }
        }

        $preco = (float)str_replace(',', '.', $produto['preco_produtos']);
        $parcelas = $preco / 6;

        $categorias_organizadas[$nome_categoria]['itens'][] = [
            'id' => $produto['id_produto'],
            'nome' => $produto['nome_produtos'],
            'preco' => $preco,
            'img' => $caminho_imagem,
            'alt' => $produto['descricao_produtos'],
            'parcelas' => $parcelas,
        ];
    }
    
    // Reordenar conforme a ordem definida
    $categorias_ordenadas = [];
    foreach ($ordem_categorias as $cat) {
        // Verificar se está no mapa
        $cat_real = $cat;
        if (in_array($cat, $mapa_categorias)) {
            $cat_real = array_search($cat, $mapa_categorias);
        }
        
        if (isset($categorias_organizadas[$cat])) {
            $categorias_ordenadas[$cat] = $categorias_organizadas[$cat];
        }
    }
    
    // Adicionar categorias não listadas no final
    foreach ($categorias_organizadas as $cat => $dados) {
        if (!isset($categorias_ordenadas[$cat])) {
            $categorias_ordenadas[$cat] = $dados;
        }
    }

    http_response_code(200);
    echo json_encode(array_values($categorias_ordenadas), JSON_UNESCAPED_UNICODE);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erro ao conectar ao banco: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
    exit;
}
?>
