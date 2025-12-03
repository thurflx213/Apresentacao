<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Produtos;
use App\Koketsu\Database\Database;
use App\Koketsu\Models\Pedidos;
use App\Koketsu\Models\ItensPedidos;

class PublicApiController {
    private $produtosModel;
    private $pedidosModel;
    private $itenspedidosModel;
     private $chaveAPI = "9D67A537A9329E0F1E9D088A1C991F1CC728EA87D3D154B409ED3320EA940303";
    public function __construct() {
        $db = Database::getInstance();
        $this->produtosModel = new Produtos($db);
        $this->pedidosModel = new Pedidos($db);
        $this->itenspedidosModel = new ItensPedidos($db);
    }
      private function buscaChaveAPI(){
        $headers = getallheaders(); 
        if (!isset($headers["Authorization"])){
            return false;
        }
        $token = explode(" ",$headers["Authorization"])[1];
        return $token === $this->chaveAPI;
    }
  public function getProdutos($pagina=0) {
       if (!$this->buscaChaveAPI()){
        http_response_code(500);
        echo json_encode([
            'status' => 'error', 'message' => 'Chave de API invalida'
        ]);
        exit;
        }
      $registros_por_pagina = $pagina===0 ? 200 : 5;
        $pagina = $pagina===0 ? 1 : (int)$pagina;
       $dados = $this->produtosModel->paginacaoAPI($pagina,$registros_por_pagina);
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'data' => $dados
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
    }
  
    public function getPedidos($pagina=0) {
    if (!$this->buscaChaveAPI()){
        http_response_code(500);
        echo json_encode([
            'status' => 'error', 'message' => 'Chave de API invalida'
        ]);
        exit;
        }
    
     $registros_por_pagina = $pagina===0 ? 200 : 5;
        $pagina = $pagina===0 ? 1 : (int)$pagina;
       $dados = $this->pedidosModel->paginacaoAPI($pagina,$registros_por_pagina);
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'data' => $dados
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
    }

      public function getItenspedidos($pagina=0) {
       if (!$this->buscaChaveAPI()){
        http_response_code(500);
        echo json_encode([
            'status' => 'error', 'message' => 'Chave de API invalida'
        ]);
        exit;
        }
      $registros_por_pagina = $pagina===0 ? 200 : 5;
        $pagina = $pagina===0 ? 1 : (int)$pagina;
       $dados = $this->itenspedidosModel->paginacaoAPI($pagina,$registros_por_pagina);
       // & NO FOREAch anexa a mudança nos dados reais do array
         unset($itenspedidos);
         header('Content-Type: application/json');
         http_response_code(200);
         echo json_encode([
            'status' => 'success',
            'data' => $dados

         ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
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

    // Extrai os campos esperados do payload (ajuste os nomes conforme seu cliente envia)
    $nome = isset($carrinho['nome']) ? $carrinho['nome'] : null;
    $email = isset($carrinho['email']) ? $carrinho['email'] : null;
    $telefone = isset($carrinho['telefone']) ? $carrinho['telefone'] : null;
    $itens = isset($carrinho['itens']) ? $carrinho['itens'] : (isset($carrinho['items']) ? $carrinho['items'] : null);

    // Validação básica dos campos obrigatórios
    if (!$nome || !$email || !$telefone || empty($itens) || !is_array($itens)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Dados do pedido incompletos. É necessário nome, email, telefone e itens.'
        ]);
        exit;
    }

    // Chama o método com 4 argumentos conforme esperado pela assinatura
    $novoPedidoId = $this->pedidosModel->inserirPedido($nome, $email, $telefone, $itens);

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