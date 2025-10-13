<?php
namespace App\apresentacao\controllers;

use App\backend\model\Carrinho; 
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Core\FileManager;

class CarrinhoControllers {
    public $carrinho;
    public $db;
    public $gerenciarImagem;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->carrinho = new Carrinho($this->db);
        $this->gerenciarImagem = new FileManager('upload');
    }

    // index
    public function index(){
        $resultado = $this->carrinho->buscarCarrinhos();
        return $resultado;
    }
    
    // View para listar e exibir dados de paginação
    public function viewListarCarrinho($pagina){
        $dados = $this->carrinho->paginacao($pagina);
        $total = $this->carrinho->totalDeCarrinhos(); // Total de ativos
        $total_inativos = $this->carrinho->buscarCarrinhosInativos(); // Contagem de inativos
        $total_ativos = $this->carrinho->buscarCarrinhosAtivos(); // Contagem de ativos
        
        View::render('carrinho/index', 
            [
                "carrinhos" => $dados['data'],
                "total_carrinhos" => $total,
                "total_inativos" => $total_inativos,
                "total_ativos" => $total_ativos,
                'paginacao' => $dados
            ] 
        );
    }

    public function viewCriarCarrinho(){
        View::render("carrinho/create");
    }

    public function viewEditarCarrinho(int $id){
       // Usando buscarCarrinhoPorId, que retorna APENAS carrinhos ativos
       $dados = $this->carrinho->buscarCarrinhoPorId($id);

       // Se o método fetch() do PDO não encontrar nada, $dados será false ou null (a depender do seu modelo)
       if (!$dados) {
           Redirect::redirecionarComMensagem("carrinho/listar", "error", "Carrinho não encontrado ou inativo!");
           return; // Interrompe a execução
       }
       
       // var_dump($dados); // Removido para evitar quebrar o View::render
       View::render("carrinho/edit", ["carrinho" => $dados]);
    }


    public function viewExcluirCarrinho($id){
          View::render("carrinho/delete", ["id_carrinho" => $id]);
    }

    public function relatorioCarrinho($id, $data1, $data2){
       View::render("carrinho/relatorio",
            ["id" => $id, "data1" => $data1, "data2" => $data2]
        );
    }

    // --- Métodos de CRUD (Lógica de Persistência) ---

    // Lógica para salvar novo carrinho (usando os campos de carrinho/pedido)
    public function salvarCarrinho(){
        // Note: Assumindo que você está passando os dados de ID do cliente, total e status via POST
        // Você deve ajustar estes parâmetros conforme seu formulário de criação.

        $id_cliente = $_POST["id_cliente"] ?? null; 
        $total_carrinho = $_POST["total_carrinho"] ?? 0.0;
        $status_carrinho = $_POST["status_carrinho"] ?? "Aberto";

        // Verifica se os dados mínimos estão presentes
        if (is_null($id_cliente)) {
             Redirect::redirecionarComMensagem("carrinho/create", "error", "ID do cliente é obrigatório.");
             return;
        }

        $novoId = $this->carrinho->inserirCarrinho(
             $id_cliente,
             $total_carrinho,
             $status_carrinho
         );

        if($novoId !== false){
            Redirect::redirecionarComMensagem("carrinho/listar", "success", "Carrinho ID {$novoId} criado com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("carrinho/create", "error", "Erro ao criar carrinho. Tente novamente.");
        }
    }
    
    // Lógica para atualizar carrinho
    public function atualizarCarrinho(){
        $id_carrinho = $_POST['id_carrinho'] ?? null;
        $total_carrinho = $_POST['total_carrinho'] ?? null;
        $status_carrinho = $_POST['status_carrinho'] ?? null;

        if (is_null($id_carrinho)) {
            Redirect::redirecionarComMensagem("carrinho/listar", "error", "ID do carrinho não fornecido.");
            return;
        }

        if ($this->carrinho->atualizarCarrinho($id_carrinho, $total_carrinho, $status_carrinho)) {
            Redirect::redirecionarComMensagem("carrinho/listar", "success", "Carrinho ID {$id_carrinho} atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("carrinho/edit/{$id_carrinho}", "error", "Erro ao atualizar carrinho. Ele pode estar inativo.");
        }
    }
    
    // Lógica para exclusão lógica
    public function deletarCarrinho(){
        $id_carrinho = $_POST['id_carrinho'] ?? null;

        if (is_null($id_carrinho)) {
            Redirect::redirecionarComMensagem("carrinho/listar", "error", "ID do carrinho não fornecido para exclusão.");
            return;
        }

        if ($this->carrinho->deletarCarrinho($id_carrinho)) {
            Redirect::redirecionarComMensagem("carrinho/listar", "success", "Carrinho ID {$id_carrinho} excluído (inativado) com sucesso!");
        } else {
            // Isso geralmente acontece se o ID não existir
            Redirect::redirecionarComMensagem("carrinho/listar", "error", "Erro ao excluir carrinho ou ID não encontrado.");
        }
    }
}
