<?php
namespace App\Koketsu\controllers;

use App\Koketsu\model\EstoqueMovimentacao; 
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
    public function salvarEstoqueMovimentacao() {
       $id_produto = $_POST["id_produto"] ?? null;
       $tipo = $_POST["tipo_estoque_movimentacao"] ?? null;
       $quantidade = $_POST["quantidade_estoque_movimentacao"] ?? null;
       $data = $_POST["data_movimentacao_estoque_movimentacao"] ?? null;
       $descricao = $_POST["descricao_estoque_movimentacao"] ?? null;

       if (is_null($id_produto) || is_null($tipo) || is_null($quantidade) || is_null($data)) {
           Redirect::redirecionarComMensagem("estoque_movimentacao/create", "error", "Todos os campos são obrigatórios.");
           return;
       }

       if ($this->estoque_movimentacao->inserirMovimentacao($id_produto, $tipo, $quantidade, $data, $descricao)) {
           Redirect::redirecionarComMensagem("estoque_movimentacao/listar", "success", "Movimentação de estoque salva com sucesso!");
       } else {
           Redirect::redirecionarComMensagem("estoque_movimentacao/create", "error", "Erro ao salvar movimentação de estoque.");
       }
    }
    
    public function atualizarEstoqueMovimentacao(){
        $id_movimentacao = $_POST["id_estoque_movimentacao"] ?? null;
        $quantidade = $_POST["quantidade_estoque_movimentacao"] ?? null;
        $descricao = $_POST["descricao_estoque_movimentacao"] ?? null;
        
        if (is_null($id_movimentacao)) {
            Redirect::redirecionarComMensagem("estoque_movimentacao/listar", "error", "ID da movimentação não fornecido.");
            return;
        }

        if ($this->estoque_movimentacao->atualizarMovimentacao((int)$id_movimentacao, $quantidade, $descricao)) {
            Redirect::redirecionarComMensagem("estoque_movimentacao/listar", "success", "Movimentação ID {$id_movimentacao} atualizada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("estoque_movimentacao/edit/{$id_movimentacao}", "error", "Erro ao atualizar a movimentação.");
        }
    }
    
        public function deletarEstoqueMovimentacao(){
        $id_movimentacao = $_POST['id_estoque_movimentacao'] ?? null;

        if (is_null($id_movimentacao)) {
            Redirect::redirecionarComMensagem("estoque_movimentacao/listar", "error", "ID da movimentação não fornecido para exclusão.");
            return;
        }

        if ($this->estoque_movimentacao->excluirMovimentacao((int)$id_movimentacao)) {
            Redirect::redirecionarComMensagem("estoque_movimentacao/listar", "success", "Movimentação ID {$id_movimentacao} excluída (inativada) com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("estoque_movimentacao/delete/{$id_movimentacao}", "error", "Erro ao excluir movimentação.");
        }
    }
}