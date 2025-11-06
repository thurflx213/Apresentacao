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
    $total = $this->pedidos->totalDePedidos(); // ⭐️ CHAMA A NOVA FUNÇÃO


    $total_pedidos = (int) $total;

    View::render("pedidos/index", [
        "pedidos" => $dados['data'] ?? [],
        "total_pedidos" => $total_pedidos ?? 0,
        "total_inativos" => 0, // Se quiser calcular inativos, precisa de uma nova função
        "total_ativos" => $total_pedidos ?? 0, // Se 'total' já é total de ativos
        "paginacao" => $dados
    ]);
}
public function viewDetalhesPedido(int $id) {
   
    $itensPedidosModel = new \App\Koketsu\Models\ItensPedidos($this->db); 
    $pedido = $this->pedidos->buscarPedidoPorId($id); 

    if (!$pedido) {
   
        Redirect::redirecionarComMensagem("/pedido/listar", "error", "Pedido não encontrado.");
        return;
    }

    $itens = $itensPedidosModel->buscarItensPorPedido($id); 
    View::render('pedidos/detalhes', [
        'pedido' => $pedido,
        'itens' => $itens
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
    
    // 1. Receber e Tratar os Dados
    $id_perfil = $_POST['id_perfil'] ?? NULL; 
    
    $data_pedido = $_POST['data_pedido'] ?? null;
    $total_pedido_str = $_POST['total_pedido'] ?? '0.00';
    $total_pedido = (float)str_replace(',', '.', $total_pedido_str);
    $status_pedido = $_POST['status_pedido'] ?? 'pendente';
    
    $itens_pedido = $_POST['itens'] ?? []; 


    // 2. Validação
    if (empty($id_perfil) || empty($data_pedido) || $total_pedido <= 0 || empty($itens_pedido)) {
        Redirect::redirecionarComMensagem("/pedido/criar", "error", "Preencha o Perfil, a Data, o Total e adicione pelo menos um Item.");
        return;
    }


    // 3. Salvar o pedido principal
    $novo_id_pedido = $this->pedidos->inserirPedido(
        $id_perfil, 
        $data_pedido, 
        $total_pedido, 
        $status_pedido
    );


    if ($novo_id_pedido) {
        
        // 4. Salvar os itens do pedido
        $todos_itens_salvos = true;
        
        foreach ($itens_pedido as $item) {
            
            $id_produto       = $item['id_produto'] ?? NULL;
            $quantidade       = $item['quantidade'] ?? 0;
            $preco_unitario   = (float)str_replace(',', '.', ($item['preco_unitario'] ?? '0.00')); 

            if ($id_produto && $quantidade > 0 && $preco_unitario > 0) {
                // Assumindo que $this->itensPedidos está instanciado no Controller
                $id_item_salvo = $this->itenspedidos->inserirItemPedido(
                    $novo_id_pedido, 
                    $id_produto, 
                    $quantidade, 
                    $preco_unitario
                );
                
                if (!$id_item_salvo) {
                    $todos_itens_salvos = false;
                    break; 
                }
            } else {
                $todos_itens_salvos = false;
                break;
            }
        }
        
        // 5. Finalização
        if ($todos_itens_salvos) {
            Redirect::redirecionarComMensagem("/pedido/listar", "success", "Pedido e Itens cadastrados com sucesso! ID: " . $novo_id_pedido);
        } else {
            // Reverter ou deletar o pedido principal aqui seria o ideal
            Redirect::redirecionarComMensagem("/pedido/criar", "error", "Pedido principal salvo, mas erro ao cadastrar os Itens.");
        }

    } else {
        // Falha no Model ao salvar o Pedido Principal
        Redirect::redirecionarComMensagem("/pedido/criar", "error", "Erro ao cadastrar pedido principal. Verifique se o ID do Perfil existe no banco.");
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
