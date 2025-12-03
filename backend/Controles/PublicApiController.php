<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Produtos;
use App\Koketsu\Database\Database;
use App\Koketsu\Models\Pedidos;

class PublicApiController {
    private $produtosModel;
    private $pedidosModel;
    public function __construct() {
        $db = Database::getInstance();
        $this->produtosModel = new produtos($db);
        $this->pedidosModel = new Pedidos($db);
    }
    
  public function getProdutos() {
    
    $dados = $this->produtosModel->buscarProdutosAtivos();
    foreach ($dados as &$produtos) {
        $produtos['caminho_imagem'] = '/backend/upload/' . $produtos['imagem_produtos'];
    }
    unset($produtos);
    
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode(['status' => 'success', 'data' => $dados], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
  }


  public function salvarPedido() {
    header('Content-Type: application/json');
    $carrinho = json_decode(file_get_contents('php://input'), true);
    if (empty($carrinho) || !is_array($carrinho)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Nenhum item recebido no carrinho.'
        ]);
        exit;
    }
    // Prepare four arguments expected by inserirPedido: items, nome, email, telefone
    $itens = $carrinho['itens'] ?? $carrinho;
    $nome = $carrinho['cliente']['nome'] ?? $carrinho['nome'] ?? '';
    $email = $carrinho['cliente']['email'] ?? $carrinho['email'] ?? '';
    $telefone = $carrinho['cliente']['telefone'] ?? $carrinho['telefone'] ?? '';
    $novoPedidoId = $this->pedidosModel->inserirPedido($itens, $nome, $email, $telefone);
    if ($novoPedidoId) {
        http_response_code(201);
        echo json_encode([
            'status' => 'success',
            'message' => 'Pedido recebido com sucesso!',
            'id_pedido' => $novoPedidoId
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Ocorreu um erro ao processar seu pedido. Tente novamente.'
        ]);
    }
    exit;
}
}