<?php
namespace App\apresentacao\controllers;

use App\backend\model\EstoqueMovimentacao; 
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Core\FileManager;

class Estoque_MovimentacaoControllers {
    public EstoqueMovimentacao $estoque_movimentacao;
    public $db;
    public $gerenciarImagens;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->estoque_movimentacao = new EstoqueMovimentacao($this->db);
        $this->gerenciarImagens = new FileManager("upload");
    }

    // index
    public function index(){
        $resultado = $this->estoque_movimentacao->buscarEstoqueMovimentacao();
        return $resultado;
    }

    public function viewListarEstoqueMovimentacao($pagina){
        // Exemplo de uso de paginação (você deve usar $pagina aqui)
        $dados = $this->estoque_movimentacao->paginacao($pagina); 
        View::render('estoque_movimentacao/index', [
            "estoque_movimentacao" => $dados['data'],
            'paginacao' => $dados
        ]);
    }

    public function viewCriarEstoqueMovimentacao(){
        View::render("estoque_movimentacao/create");
    }

    public function viewEditarEstoqueMovimentacao(int $id){
       $dados = $this->estoque_movimentacao->buscarEstoqueMovimentacaoPorId($id);

       if (empty($dados)) {
           Redirect::redirecionarComMensagem("estoque_movimentacao/listar", "error", "Movimentação não encontrada.");
           return;
       }

       View::render("estoque_movimentacao/edit", ["estoque_movimentacao" => $dados]);
    }


    public function viewExcluirEstoqueMovimentacao($id){
          View::render("estoque_movimentacao/delete", ["id_estoque_movimentacao" => $id]);
    }
    
    public function relatorioEstoqueMovimentacao($id, $data1, $data2){
        View::render("estoque_movimentacao/relatorio",
            ["id" => $id, "data1" => $data1, "data2" => $data2]
        );
    }
    
    // MÉTODO RENOMEADO: Corrigido para corresponder à chamada da rota/view.
    /**
     * Processa a submissão do formulário e salva a nova movimentação.
     */
    public function salvarEstoqueMovimentacao() {
        // Verifica se os campos obrigatórios estão presentes
        if (
            empty($_POST["id_produto"]) ||
            empty($_POST["tipo_estoque_movimentacao"]) ||
            empty($_POST["quantidade_estoque_movimentacao"])
        ) {
            Redirect::redirecionarComMensagem("estoque_movimentacao/create", "error", "Preencha todos os campos obrigatórios.");
            return;
        }

        // Sanitiza e coleta os dados
        $id_produto = (int)$_POST["id_produto"];
        $tipo = $_POST["tipo_estoque_movimentacao"]; // 'ENTRADA' ou 'SAIDA'
        $quantidade = (int)$_POST["quantidade_estoque_movimentacao"];
        // Descrição é opcional
        $descricao = !empty($_POST["descricao_estoque_movimentacao"]) ? $_POST["descricao_estoque_movimentacao"] : null;

        // Chama o método de inserção do modelo
        $novoId = $this->estoque_movimentacao->inserirMovimentacao(
            $id_produto,
            $tipo,
            $quantidade,
            $descricao
        );

        if ($novoId !== false) {
            Redirect::redirecionarComMensagem("estoque_movimentacao/listar", "success", "Movimentação registrada com sucesso (ID: {$novoId})!");
        } else {
            Redirect::redirecionarComMensagem("estoque_movimentacao/create", "error", "Erro ao registrar a movimentação. Tente novamente.");
        }
    }
    
    public function atualizarEstoqueMovimentacao(){
        // Lógica de atualização a ser implementada, se necessário
        echo "Lógica de atualização (PUT/POST) de Estoque Movimentacao.";
    }
    
    public function deletarEstoqueMovimentacao(){
        // Lógica de exclusão a ser implementada, se necessário
        echo "Lógica de exclusão (DELETE/POST) de Estoque Movimentacao.";
    }
}
