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
        $resultado = $this->avaliacao->buscarAvaliacoes($pagina);
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

    //    foreach($dados as $categoria){
    //     $dados = $categoria;
    //    }
       var_dump($dados);
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
       if($this->avaliacao->inserirAvaliacao(
            $_POST["nome_avaliacoes"],
            $_POST["descricao_avaliacoes"],
            "Ativo",
            date('Y-m-d H:i:s')
        )){
            Redirect::redirecionarComMensagem("avaliacao/listar", "success", "Avaliação criada com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("avaliacao/create", "error", "Erro ao criar avaliação. Tente novamente.");
        }
    }
    public function atualizarAvaliacao(){
        echo "Atualizar avaliação";
    }
    public function deletarAvaliacao(){
        echo "Deletar avaliação";
    }

}