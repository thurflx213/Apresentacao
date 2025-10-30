<?php
namespace App\Koketsu\controllers;

use App\Koketsu\Model\Avaliacao; 
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Core\FileManager;

class AvaliacaoController {
    public $avaliacao;
    public $db;
    public $gerenciarImagem;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->avaliacao = new Avaliacao($this->db);
        $this->gerenciarImagem = new FileManager('upload');
    }
    // index
    public function index($pagina = 1){
        // CORREÇÃO: O método 'buscarAvaliacoes' no Model parece não aceitar paginação, usar 'paginacao'
        $resultado = $this->avaliacao->paginacao($pagina);
        return $resultado;
    }
     public function viewListaravaliacao($pagina){
    $dados = $this->avaliacao->paginacao($pagina);
    $total = $this->avaliacao->Avaliacao();
    $total_inativos = $this->avaliacao->buscarAvaliacoesInativos();
    $total_ativos = $this->avaliacao->buscarAvaliacoesAtivos();
    view::render('avaliacao/index', 
    [
        "avaliacoes" => $dados['data'],
        "total_avaliacoes" => $total,
        "total_inativos" => $total_inativos,
        "total_ativos" => $total_ativos,
        'paginacao' => $dados
    ] 
  );
}

    public function viewCriarAvaliacao(){
        view::render("avaliacao/create");
    }

    public function viewEditarAvaliacao(int $id){
       $dados = $this->avaliacao->buscarAvaliacaoPorId($id);

       if (empty($dados)) {
           Redirect::redirecionarComMensagem("avaliacao/listar", "error", "Avaliação não encontrada ou inativa.");
           return;
       }

       // CORREÇÃO: Removido var_dump($dados);
       view::render("avaliacao/edit", ["avaliacao" => $dados]);
    }


    public function viewExcluirAvaliacao($id){
         view::render("avaliacao/delete", ["id_avaliacao" => $id]);
    }

    public function relatorioAvaliacao($id, $data1, $data2){
     view::render("avaliacao/relatorio",
           ["id" => $id, "data1" => $data1, "data2" => $data2]
      );
    }

    public function salvarAvaliacao(){
        $id_produto = $_POST["id_produto"] ?? null;
        $id_cliente = $_POST["id_cliente"] ?? null;
        $nota = $_POST["nota_avaliacoes"] ?? null;
        $comentario = $_POST["comentario_avaliacoes"] ?? null;
        
        // Verificação mínima
        if (is_null($id_produto) || is_null($id_cliente) || is_null($nota)) {
             Redirect::redirecionarComMensagem("avaliacao/create", "error", "Produto, cliente e nota são obrigatórios.");
             return;
        }
        
        if($this->avaliacao->inserirAvaliacao(
            (int)$id_produto,
            (int)$id_cliente,
            (float)$nota,
            $comentario
        )){
            Redirect::redirecionarComMensagem("avaliacao/listar", "success", "Avaliação criada com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("avaliacao/create", "error", "Erro ao criar avaliação. Tente novamente.");
        }
    }
    
    public function atualizarAvaliacao(){
        $id_avaliacoes = $_POST['id_avaliacoes'] ?? null;
        $nota = $_POST['nota_avaliacoes'] ?? null;
        $comentario = $_POST['comentario_avaliacoes'] ?? null;

        if (is_null($id_avaliacoes)) {
            Redirect::redirecionarComMensagem("avaliacao/listar", "error", "ID da avaliação não fornecido para atualização.");
            return;
        }
        
        if (is_null($nota) || !is_numeric($nota) || $nota < 1 || $nota > 5) {
             Redirect::redirecionarComMensagem("avaliacao/edit/{$id_avaliacoes}", "error", "Nota inválida. Deve ser entre 1 e 5.");
             return;
        }

        if ($this->avaliacao->atualizarAvaliacao((int)$id_avaliacoes, (float)$nota, $comentario)) {
            Redirect::redirecionarComMensagem("avaliacao/listar", "success", "Avaliação ID {$id_avaliacoes} atualizada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("avaliacao/edit/{$id_avaliacoes}", "error", "Erro ao atualizar avaliação. Ele pode estar inativo.");
        }
    }
    
    public function deletarAvaliacao(){
        $id_avaliacoes = $_POST['id_avaliacoes'] ?? null;

        if (is_null($id_avaliacoes)) {
            Redirect::redirecionarComMensagem("avaliacao/listar", "error", "ID da avaliação não fornecido para exclusão.");
            return;
        }

        if ($this->avaliacao->excluirAvaliacao((int)$id_avaliacoes)) {
            Redirect::redirecionarComMensagem("avaliacao/listar", "success", "Avaliação ID {$id_avaliacoes} excluída (inativada) com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("avaliacao/delete/{$id_avaliacoes}", "error", "Erro ao excluir avaliação.");
        }
    }

}