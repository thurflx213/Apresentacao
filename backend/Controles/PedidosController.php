<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Pedidos;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Models\ItensPedidos;
use App\Koketsu\Core\FileManager;
use App\Koketsu\Controles\Admin\AdminController;

class PedidosController extends AdminController {
    public $pedidos;
    public $itenspedidos; 
    public $db;
    public $gerenciarImagem;

public function __construct() {
        parent::__construct();
        $this->db = Database::getInstance();
        $this->pedidos = new Pedidos($this->db);
        $this->itenspedidos = new ItensPedidos($this->db); 
        $this->gerenciarImagem = new FileManager('upload');
    }

   public function index(){
    $this->viewListarPedido();
}  

 
    public function viewPedidoUnico(int $id_pedido) {
        // 1. Buscar os dados do pedido principal
        $pedido = $this->pedidos->buscarPedidoPorId($id_pedido);
        
        // 2. Buscar todos os itens associados a este pedido
        $itens_pedido = $this->itenspedidos->buscarItensPorPedido($id_pedido);
        
        if ($pedido) {
            // Se o pedido for encontrado, exibe a view com os dados
            View::render('pedidos/detalhes', [
                'pedido' => $pedido,
                'itens' => $itens_pedido
            ]);
        } else {
            // Se não encontrar, redireciona com mensagem de erro
            Redirect::redirecionarComMensagem("/pedido/listar", "error", "Pedido não encontrado.");
        }
    }
   
    public function viewListarPedido() {
        $dados = $this->pedidos->paginacao();
        $total = $this->pedidos->totalDePedidos();

        $total_pedidos = is_array($total) ? reset($total) : $total;

        View::render("pedidos/index", [
            "pedidos" => $dados['data'] ?? [],
            "total_pedidos" => $total_pedidos ?? 0,
            "total_inativos" => 0,
            "total_ativos" => 0,
            "paginacao" => $dados
        ]);
    }

  
    public function viewCriarPedidos() {
        View::render("pedidos/create");
    }

    
    public function viewEditarPedido(int $id) {
        $dados = $this->pedidos->buscarPedidoPorId($id);

        if (!$dados) {
            Redirect::redirecionarComMensagem("/pedido/listar", "error", "Pedido não encontrado.");
            return;
        }

        View::render('pedidos/edit', ['pedido' => $dados]);
    }

   
    public function atualizarPedidos() {
    $id_pedido = $_POST["id_pedido"] ?? null;
    $total_pedido = $_POST["total_pedido"] ?? 0;
    $data_pedido = $_POST["data_pedido"] ?? null;
    $status_pedido = $_POST["status_pedido"] ?? null;
    
    
    $imagem = $_POST["imagem_pedidos"] ?? null; 
    
 
    if ($this->pedidos->atualizarPedido($id_pedido, $total_pedido, $data_pedido, $status_pedido, $imagem)) { 
        Redirect::redirecionarComMensagem("/pedido/listar", "success", "pedido atualizado com sucesso!");
    } else {
        Redirect::redirecionarComMensagem("/pedido/editar/" . $id_pedido, "error", "Erro ao atualizar pedido!");
    }
}

public function salvarPedido() {
        // Coleta de dados do Pedido Principal
        $id_cliente = $_POST['id_cliente'] ?? null;
        $data_pedido = $_POST['data_pedido'] ?? null;
        $total_pedido = isset($_POST['total_pedido']) ? (float)$_POST['total_pedido'] : 0.00;
        $status_pedido = $_POST['status_pedido'] ?? 'pendente'; 
        
        // Coleta de dados do Item (ASSUMINDO que o form tem id_produto e quantidade)
        $id_produto = $_POST['id_produto'] ?? null;
        $quantidade = isset($_POST['quantidade']) ? (int)$_POST['quantidade'] : 1;
        
        // 1. Validação básica
        if (empty($id_cliente) || empty($data_pedido) || empty($total_pedido) || empty($id_produto)) {
            Redirect::redirecionarComMensagem("/pedido/criar", "error", "Preencha todos os campos obrigatórios (Cliente, Data, Total e Produto).");
            return; 
        }

        // 2. Salvar o pedido principal e obter o ID
        $novo_id_pedido = $this->pedidos->inserirPedido(
            $id_cliente,
            $data_pedido,
            $total_pedido,
            $status_pedido
        );
        
        if ($novo_id_pedido) {
            
            // 3. Salvar o Item do Pedido usando o ID recém-criado
            $preco_unitario = $total_pedido / $quantidade; 
            
            // CORRIGIDO: Chamada para o método da sua Model ItensPedidos
            $item_salvo = $this->itenspedidos->inserirItemPedido( 
                $novo_id_pedido, 
                $id_produto, 
                $quantidade, 
                $preco_unitario 
            );
            
            if ($item_salvo) {
                Redirect::redirecionarComMensagem("/pedido/listar", "success", "Pedido e Item cadastrados com sucesso!");
            } else {
                // Se o item falhar, idealmente você deve desfazer o pedido principal.
                Redirect::redirecionarComMensagem("/pedido/listar", "error", "Pedido criado, mas falha ao adicionar item! Verifique o log.");
            }

        } else {
            // Falha ao criar o pedido principal
            Redirect::redirecionarComMensagem("/pedido/criar", "error", "Erro ao cadastrar pedido principal.");
        }
    }

  
    public function viewExcluirPedido(int $id) {
     $id = (int)$_POST['id_pedido'];
        if ($this->pedidos->excluirPedido($id)) {
            Redirect::redirecionarComMensagem("/pedido/listar", "success", "Pedido inativado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/pedido/listar", "error", "Erro ao inativar pedido.");
        }
    }

   
    public function relatorioPedido($id, $data1, $data2) {
        View::render("pedidos/relatorio", [
            "id" => $id,
            "data1" => $data1,
            "data2" => $data2
        ]);
    }
}
