<?php
namespace App\Koketsu\controles;

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
     public function viewListarCategoria(){
        $dados = $this->categoria->buscarCategorias();
        view::render("categoria/index",["categoria" => $dados]);
    }

    public function viewCriarCategoria(){
        view::render("categoria/create");
    }

    public function viewEditarCategoria(int $id){
       $dados = $this->categoria->buscarCategoriaPorId($id);
       
    //    foreach($dados as $categoria){
    //     $dados = $categoria;
    //    }
       var_dump($dados);
       view::render("categoria/edit", ["categoria" => $dados]);
    }


    public function viewExcluirCategoria($id){
         view::render("categoria/delete", ["id_categorias" => $id]);
    }

    public function relatorioCategoria($id, $data1, $data2){
     view::render("categoria/relatorio",
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
    public function atualizarCategoria(){
        echo "Atualizar categoria";
    }
    public function deletarCategoria(){
        echo "Deletar categoria";
    }   

}