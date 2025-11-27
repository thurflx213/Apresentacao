<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Carrinho;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;

class CarrinhoController {
    public $carrinho;
    public $db;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = Database::getInstance();
        $this->carrinho = new Carrinho($this->db);
    }

    // --- LÓGICA DO FRONTEND (LOJA) ---

    /**
     * Recebe o POST do formulário de produto e adiciona ao carrinho
     */
    public function adicionarAoCarrinho() {
        $id_produto = filter_input(INPUT_POST, 'id_produto', FILTER_SANITIZE_NUMBER_INT);
        $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT) ?? 1;
        
        // Em produção, pegue o ID do cliente logado: $_SESSION['usuario']['id']
        // Aqui estou fixando '1' para testes, caso não haja login feito.
        $id_cliente = $_SESSION['id_cliente'] ?? 1; 

        if (!$id_produto) {
            Redirect::redirecionarComMensagem("/", "error", "Produto inválido!");
            return;
        }

        // 1. Verifica/Cria a sessão do carrinho
        if (!isset($_SESSION['carrinho_id'])) {
            // Cria um novo carrinho "Aberto" no banco
            $novoId = $this->carrinho->inserirCarrinho($id_cliente, 0.00, 'Aberto');
            
            if ($novoId) {
                $_SESSION['carrinho_id'] = $novoId;
            } else {
                Redirect::redirecionarComMensagem("/", "error", "Erro ao iniciar carrinho.");
                return;
            }
        }

        // 2. Adiciona o item ao carrinho existente
        $id_carrinho = $_SESSION['carrinho_id'];
        
        if ($this->carrinho->adicionarItem($id_carrinho, $id_produto, $quantidade)) {
            Redirect::redirecionarComMensagem("meu-carrinho", "success", "Produto adicionado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("meu-carrinho", "error", "Erro ao adicionar item.");
        }
    }

    /**
     * Exibe a página do carrinho do cliente
     */
    public function verCarrinho() {
        $itens = [];
        $total = 0.00;
        $id_carrinho = $_SESSION['carrinho_id'] ?? null;

        if ($id_carrinho) {
            $itens = $this->carrinho->buscarItensCarrinho($id_carrinho);
            $dadosCarrinho = $this->carrinho->buscarCarrinhoPorId($id_carrinho);
            $total = $dadosCarrinho['total_carrinho'] ?? 0.00;
        }

        // Renderiza a view da pasta 'loja'
        View::render("loja/carrinho", [
            "itens" => $itens,
            "total" => $total
        ]);
    }

    /**
     * Remove item do carrinho
     */
    public function removerDoCarrinho($id_item) {
        $id_carrinho = $_SESSION['carrinho_id'] ?? null;

        if ($id_carrinho && $this->carrinho->removerItem($id_item, $id_carrinho)) {
            Redirect::redirecionarComMensagem("meu-carrinho", "success", "Item removido.");
        } else {
            Redirect::redirecionarComMensagem("meu-carrinho", "error", "Erro ao remover item.");
        }
    }

    // --- LÓGICA DO BACKEND (ADMIN) ---
    // Mantive seus métodos de administração abaixo

    public function index(){
        return $this->carrinho->buscarCarrinhos();
    }
    
    public function viewListarCarrinho($pagina){
        $dados = $this->carrinho->paginacao($pagina);
        View::render('carrinho/index', [
            "carrinhos" => $dados['data'],
            "total_carrinhos" => $this->carrinho->totalDeCarrinhos(),
            "paginacao" => $dados
        ]);
    }

    public function viewCriarCarrinho(){
        View::render("carrinho/create");
    }

    public function viewEditarCarrinho(int $id){
       $dados = $this->carrinho->buscarCarrinhoPorId($id);
       if (!$dados) {
           Redirect::redirecionarComMensagem("carrinho/listar", "error", "Carrinho não encontrado!");
           return;
       }
       View::render("carrinho/edit", ["carrinho" => $dados]);
    }

    public function viewExcluirCarrinho($id){
          View::render("carrinho/delete", ["id_carrinho" => $id]);
    }

    public function salvarCarrinho(){
        $id_cliente = $_POST["id_cliente"] ?? null; 
        $total = $_POST["total_carrinho"] ?? 0;
        $status = $_POST["status_carrinho"] ?? "Aberto";

        if ($this->carrinho->inserirCarrinho($id_cliente, $total, $status)) {
            Redirect::redirecionarComMensagem("carrinho/listar", "success", "Carrinho criado!");
        } else {
            Redirect::redirecionarComMensagem("carrinho/create", "error", "Erro ao criar.");
        }
    }
    
    public function atualizarCarrinho(){
        $id = $_POST['id_carrinho'] ?? null;
        $total = $_POST['total_carrinho'] ?? null;
        $status = $_POST['status_carrinho'] ?? null;

        if ($this->carrinho->atualizarCarrinho($id, $total, $status)) {
            Redirect::redirecionarComMensagem("carrinho/listar", "success", "Atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("carrinho/listar", "error", "Erro ao atualizar.");
        }
    }
    
    public function deletarCarrinho(){
        $id = $_POST['id_carrinho'] ?? null;
        if ($this->carrinho->deletarCarrinho($id)) {
            Redirect::redirecionarComMensagem("carrinho/listar", "success", "Excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("carrinho/listar", "error", "Erro ao excluir.");
        }
    }
}