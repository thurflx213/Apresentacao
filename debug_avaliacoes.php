<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;
use App\Koketsu\Models\Pedidos;
use Dotenv\Dotenv;

// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = Database::getInstance();

try {
    echo "--- INICIANDO DEBUG ---\n";

    // 1. Buscar um usuário com pedidos pagos ou concluídos
    echo "1. Buscando usuário com pedidos 'concluido' ou 'pago'...\n";
    $sql = "SELECT DISTINCT p.id_perfil
            FROM tbl_pedidos p 
            WHERE p.status_pedido IN ('concluido', 'pago', 'Concluido', 'Pago', 'CONCLUIDO', 'PAGO') 
            LIMIT 1";
    $stmt = $db->query($sql);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Nenhum usuário encontrado com pedidos pagos ou concluídos.\n";
        
        // Debug extra: listar todos os status de pedidos existentes
        echo "Status de pedidos encontrados no banco:\n";
        $stmt = $db->query("SELECT DISTINCT status_pedido FROM tbl_pedidos");
        $status = $stmt->fetchAll(PDO::FETCH_COLUMN);
        print_r($status);
        exit;
    }

    $id_perfil = $usuario['id_perfil'];
    echo "ID Perfil encontrado: $id_perfil\n";

    // 2. Listar pedidos desse usuário
    echo "\n2. Pedidos do usuário (ID Perfil: $id_perfil):\n";
    $sql = "SELECT * FROM tbl_pedidos WHERE id_perfil = :id_perfil";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id_perfil' => $id_perfil]);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Encontrados " . count($pedidos) . " pedidos.\n";
    foreach ($pedidos as $p) {
        $status = $p['status_pedido'];
        $excluido = $p['excluido_em'] === null ? 'NULL' : $p['excluido_em'];
        echo "- Pedido ID: {$p['id_pedido']}, Status: '{$status}', ExcluidoEm: {$excluido}\n";
    }

    // 3. Verificar Itens dos Pedidos
    echo "\n3. Itens dos pedidos elegíveis (concluido/pago):\n";
    foreach ($pedidos as $pedido) {
        $statusNorm = strtolower($pedido['status_pedido']);
        if (in_array($statusNorm, ['concluido', 'pago'])) { // Teste case-insensitive no PHP
            echo "-> Verificando itens do Pedido #{$pedido['id_pedido']}...\n";
            $sql = "SELECT * FROM tbl_itens_pedidos WHERE id_pedido = :id_pedido";
            $stmt = $db->prepare($sql);
            $stmt->execute(['id_pedido' => $pedido['id_pedido']]);
            $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($itens)) {
                echo "   [ERRO] Pedido sem itens na tabela tbl_itens_pedidos!\n";
            } else {
                echo "   Encontrados " . count($itens) . " itens:\n";
                foreach ($itens as $item) {
                    echo "   - Produto ID: {$item['id_produto']}\n";
                }
            }
        }
    }

    // 3.5 Verificar Avaliações Existentes
    echo "\n3.5. Avaliações existentes para este perfil:\n";
    $sql = "SELECT * FROM tbl_avaliacoes WHERE id_cliente = :id_perfil AND excluido_em IS NULL";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id_perfil' => $id_perfil]);
    $avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Encontradas " . count($avaliacoes) . " avaliações.\n";
    foreach ($avaliacoes as $av) {
        echo "- Avaliação ID: {$av['id_avaliacoes']}, Produto ID: {$av['id_produto']}\n";
    }

    // 4. Testar a query buscarProdutosCompradosPorPerfil
    echo "\n4. Testando query buscarProdutosCompradosPorPerfil (Query Original):\n";
    $pedidosModel = new Pedidos($db);
    $produtos = $pedidosModel->buscarProdutosCompradosPorPerfil($id_perfil);

    echo "Produtos retornados pelo Model: " . count($produtos) . "\n";
    if (empty($produtos)) {
        echo "A query retornou vazio. Possíveis causas:\n";
        echo "- Status no banco diferente de 'concluido'/'pago' (case sensitive?)\n";
        echo "- JOIN com tabela produtos falhando (produto não existe?)\n";
        echo "- NOT IN excluindo os produtos (já avaliados?)\n";
    } else {
        print_r($produtos);
    }

    echo "\n--- FIM DO DEBUG ---\n";

} catch (PDOException $e) {
    echo "ERRO PDO: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "ERRO GERAL: " . $e->getMessage() . "\n";
}
