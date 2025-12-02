<?php
namespace App\Koketsu\Controllers; 

use App\Koketsu\Models\Produto;

use App\Koketsu\Database\Database;
use App\Koketsu\Models\Pedidos;
use App\Koketsu\Models\Produtos;

class PublicApiController {
    private $produtoModel;
    private $pedidoModel;
    public function __construct() {
        $db = Database::getInstance();
        $this->produtoModel = new Produtos($db);
        $this->pedidoModel = new Pedidos($db);
    }

  
      public function getProdutos(){
        header('Content-Type: application/json');
        $dados = $this->produtoModel->buscarProdutos();
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => $dados], JSON_UNESCAPED_SLASHES); 
        exit;
    }
    public function salvarPedido(){
        header('Content-Type: application/json');
        $carrinho = json_decode(file_get_contents('php://input'), true);
        if(empty($carrinho) || !is_array($carrinho)) {
            echo json_encode(['status' => 'error', 'message' => 'Nenhum item recebido no carrinho.']);
        exit;
    }
    // $novoPedidoId = $this->pedidoModel->inserirPedido();
    // if ($novoPedidoId){
    //     http_response_code(201);
    //     echo json_encode([
    //         'status' => 'success', 'message' => 'Pedido recebido com sucesso!', 'id_pedido' => $novoPedidoId

    //     ]);
    // }else {
    //     http_response_code(500);
    //     echo json_encode([
    //         'status' => 'error', 'message' => 'Ocorreu um erro ao processar seu pedido. Tente novamente.'

    //     ]);
    //     }
    //     exit;
    }
    
    
  

}