<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Categoria;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;

class CategoriasController {
    public $categoria;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->categoria = new Categoria($this->db);
    }
    // index
    public function index(){
        $resultado = $this->categoria->buscarCategorias();
        return $resultado;
    }
     public function viewListarCategoria($pagina){
    $dados = $this->categoria->paginacao($pagina);
    $total = $this->categoria->totalDeCategorias($pagina);
    $total_inativos = $this->categoria->buscarCategoriasInativos($pagina);
    $total_ativos = $this->categoria->buscarCategoriasAtivos($pagina);
    View::render('categoria/index', 
    [
        "categorias" => $dados['data'],
        "total_categorias" => $total,
        "total_inativos" => $total_inativos,
        "total_ativos" => $total_ativos,
        'paginacao' => $dados
    ] 
  );
}

    public function viewCriarCategoria(){
        View::render("categoria/create");
    }

    public function viewEditarCategoria(int $id){
         $dados = $this->categoria->buscarCategoriaPorId($id);
         View::render("categoria/edit", ["categoria" => $dados]);
    }


        public function viewExcluirCategoria($id){
            View::render("categoria/delete", ["id_categorias" => $id]);
        }

        public function relatorioCategoria($id, $data1, $data2){
         View::render("categoria/relatorio",
                     ["id" => $id, "data1" => $data1, "data2" => $data2]
            );
        }

    public function salvarCategoria(){
       if($this->categoria->inserirCategoria(
            $_POST["nome_categorias"],
            $_POST["descricao_categorias"],
            "Ativo"
        )){
            Redirect::redirecionarComMensagem("categoria/listar", "success", "Categoria criada com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("categoria/create", "error", "Erro ao criar categoria. Tente novamente.");
        }
    }
    public function atualizarCategoria($id){
        if($this->categoria->atualizarCategoria(
            $id,
            $_POST["nome_categorias"],
            $_POST["descricao_categorias"],
            $_POST["status_categorias"] ?? "Ativo"
        )){
            Redirect::redirecionarComMensagem("/categoria/listar/1", "success", "Categoria atualizada com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("/categoria/editar/" . $id, "error", "Erro ao atualizar categoria.");
        }
    }
    
    public function deletarCategoria($id){
        if($this->categoria->deletarCategoria($id)){
            Redirect::redirecionarComMensagem("/categoria/listar/1", "success", "Categoria excluída com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("/categoria/listar/1", "error", "Erro ao excluir categoria.");
        }
    }   

}